<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleDriveController extends Controller
{
    const MAX_FILE_SIZE_MB = 10;
    const MAX_FILE_SIZE_BYTES = 10485760; // 10MB in bytes
    
    protected function googleClient()
    {
        $client = new Client();
        $client->setAuthConfig(base_path('google-service-account.json'));
        $client->setScopes([Drive::DRIVE]);
        $client->setAccessType('offline');

        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $client->setAccessToken(json_decode(file_get_contents($tokenPath), true));
        }

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            }
        }

        return $client;
    }

    // Extract Shared Drive or Folder ID from Google URL
    protected function extractDriveId($url)
    {
        if (preg_match('/folders\/([a-zA-Z0-9_-]+)/', $url, $m)) return $m[1];
        if (preg_match('/drive\/(.*?)(\/|$)/', $url, $m)) return $m[1];
        return null;
    }

    // Get or create user-specific subfolder
    protected function getUserFolder($driveService, $parentFolderId)
    {
        $userEmail = Auth::user()->email;
        $folderName = str_replace(['@', '.'], ['_', '_'], $userEmail);

        // Search for existing folder
        $query = "name='{$folderName}' and '{$parentFolderId}' in parents and mimeType='application/vnd.google-apps.folder' and trashed=false";
        
        $results = $driveService->files->listFiles([
            'q' => $query,
            'driveId' => $parentFolderId,
            'includeItemsFromAllDrives' => true,
            'supportsAllDrives' => true,
            'corpora' => 'drive',
            'fields' => 'files(id, name)'
        ]);

        $files = $results->getFiles();

        if (count($files) > 0) {
            return $files[0]->getId();
        }

        // Create new folder
        $folderMetadata = new DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentFolderId]
        ]);

        $folder = $driveService->files->create($folderMetadata, [
            'supportsAllDrives' => true,
            'fields' => 'id'
        ]);

        return $folder->getId();
    }

    // Check if file is a video
    protected function isVideoFile($mimeType)
    {
        return strpos($mimeType, 'video/') === 0;
    }

    // Upload file to Google Drive with optimizations
    public function uploadFile(Request $request)
    {
        try {
            // Validate file size FIRST (10MB limit)
            $request->validate([
                'file' => 'required|file|max:10240', // 10MB max (in kilobytes)
            ]);

            $file = $request->file('file');
            
            // Additional server-side size check
            if ($file->getSize() > self::MAX_FILE_SIZE_BYTES) {
                return response()->json([
                    'success' => false,
                    'message' => 'File size exceeds ' . self::MAX_FILE_SIZE_MB . 'MB limit. Please compress your video first.',
                    'fileSize' => round($file->getSize() / 1048576, 2) . 'MB',
                    'maxSize' => self::MAX_FILE_SIZE_MB . 'MB'
                ], 422);
            }

            $sharedDriveUrl = "https://drive.google.com/drive/folders/0AEC82CMaKw77Uk9PVA";
            $sharedDriveId = $this->extractDriveId($sharedDriveUrl);

            $client = $this->googleClient();
            $driveService = new Drive($client);

            // Get user-specific folder
            $userFolderId = $this->getUserFolder($driveService, $sharedDriveId);

            // Get MIME type
            $mimeType = $file->getMimeType();
            $isVideo = $this->isVideoFile($mimeType);

            // Log upload attempt
            Log::info('File upload attempt', [
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $mimeType,
                'size' => $file->getSize(),
                'is_video' => $isVideo
            ]);

            // For videos, ensure compatible MIME type
            if ($isVideo) {
                // Force MP4 MIME type for better compatibility
                if (in_array(strtolower($file->getClientOriginalExtension()), ['mp4', 'mov', 'avi', 'mkv'])) {
                    $mimeType = 'video/mp4';
                }
            }

            $fileMetadata = new DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$userFolderId],
                'mimeType' => $mimeType
            ]);

            // Upload file with resumable upload for better reliability
            $uploadedFile = $driveService->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $mimeType,
                    'uploadType' => 'resumable', // Changed from multipart for better handling
                    'supportsAllDrives' => true,
                    'fields' => 'id, name, mimeType, size, webViewLink, webContentLink, thumbnailLink'
                ]
            );

            // Make file publicly accessible with viewer role
            $permission = new Permission([
                'type' => 'anyone',
                'role' => 'reader'
            ]);

            $driveService->permissions->create(
                $uploadedFile->getId(),
                $permission,
                ['supportsAllDrives' => true]
            );

            // Generate proper links for videos
            $fileId = $uploadedFile->getId();
            $publicLink = "https://drive.google.com/file/d/{$fileId}/view";
            $previewLink = "https://drive.google.com/file/d/{$fileId}/preview";
            $embedLink = "https://drive.google.com/file/d/{$fileId}/preview?embedded=true";

            $response = [
                'success' => true,
                'fileId' => $fileId,
                'fileName' => $uploadedFile->getName(),
                'fileSize' => round($uploadedFile->getSize() / 1048576, 2) . 'MB',
                'mimeType' => $uploadedFile->getMimeType(),
                'publicLink' => $publicLink,
                'viewLink' => $uploadedFile->getWebViewLink(),
                'isVideo' => $isVideo
            ];

            // Add video-specific links
            if ($isVideo) {
                $response['previewLink'] = $previewLink;
                $response['embedLink'] = $embedLink;
                $response['message'] = 'Video uploaded successfully. Google Drive may take 5-10 minutes to process the video for streaming.';
            }

            Log::info('File uploaded successfully', ['fileId' => $fileId]);

            return response()->json($response);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'File validation failed: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('File upload failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete file from Google Drive
    public function deleteFile(Request $request)
    {
        try {
            $request->validate([
                'fileId' => 'required|string'
            ]);

            $client = $this->googleClient();
            $driveService = new Drive($client);

            $driveService->files->delete($request->fileId, [
                'supportsAllDrives' => true
            ]);

            Log::info('File deleted', ['fileId' => $request->fileId]);

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('File deletion failed', [
                'fileId' => $request->fileId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Replace existing file
    public function replaceFile(Request $request)
    {
        try {
            $request->validate([
                'fileId' => 'required|string',
                'file' => 'required|file|max:10240' // 10MB max
            ]);

            $file = $request->file('file');

            // Check file size
            if ($file->getSize() > self::MAX_FILE_SIZE_BYTES) {
                return response()->json([
                    'success' => false,
                    'message' => 'File size exceeds ' . self::MAX_FILE_SIZE_MB . 'MB limit.',
                    'fileSize' => round($file->getSize() / 1048576, 2) . 'MB',
                    'maxSize' => self::MAX_FILE_SIZE_MB . 'MB'
                ], 422);
            }

            $client = $this->googleClient();
            $driveService = new Drive($client);

            // Delete old file
            $driveService->files->delete($request->fileId, [
                'supportsAllDrives' => true
            ]);

            // Upload new file
            $sharedDriveUrl = "https://drive.google.com/drive/folders/0AEC82CMaKw77Uk9PVA";
            $sharedDriveId = $this->extractDriveId($sharedDriveUrl);
            $userFolderId = $this->getUserFolder($driveService, $sharedDriveId);

            $mimeType = $file->getMimeType();
            $isVideo = $this->isVideoFile($mimeType);

            // Force MP4 for videos
            if ($isVideo && in_array(strtolower($file->getClientOriginalExtension()), ['mp4', 'mov', 'avi', 'mkv'])) {
                $mimeType = 'video/mp4';
            }

            $fileMetadata = new DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$userFolderId],
                'mimeType' => $mimeType
            ]);

            $uploadedFile = $driveService->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $mimeType,
                    'uploadType' => 'resumable',
                    'supportsAllDrives' => true,
                    'fields' => 'id, name, mimeType, size, webViewLink'
                ]
            );

            // Make file publicly accessible
            $permission = new Permission([
                'type' => 'anyone',
                'role' => 'reader'
            ]);

            $driveService->permissions->create(
                $uploadedFile->getId(),
                $permission,
                ['supportsAllDrives' => true]
            );

            $fileId = $uploadedFile->getId();
            $publicLink = "https://drive.google.com/file/d/{$fileId}/view";
            $previewLink = "https://drive.google.com/file/d/{$fileId}/preview";

            $response = [
                'success' => true,
                'fileId' => $fileId,
                'fileName' => $uploadedFile->getName(),
                'fileSize' => round($uploadedFile->getSize() / 1048576, 2) . 'MB',
                'mimeType' => $uploadedFile->getMimeType(),
                'publicLink' => $publicLink,
                'viewLink' => $uploadedFile->getWebViewLink(),
                'isVideo' => $isVideo
            ];

            if ($isVideo) {
                $response['previewLink'] = $previewLink;
                $response['message'] = 'Video replaced successfully. Processing may take 5-10 minutes.';
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('File replacement failed', [
                'fileId' => $request->fileId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}