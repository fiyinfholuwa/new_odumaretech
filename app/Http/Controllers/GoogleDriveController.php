<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Auth;

class GoogleDriveController extends Controller
{
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

    // Upload file to Google Drive
    public function uploadFile(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:102400', // 100MB max
            ]);

            $sharedDriveUrl = "https://drive.google.com/drive/folders/0AEC82CMaKw77Uk9PVA";
            $sharedDriveId = $this->extractDriveId($sharedDriveUrl);

            $client = $this->googleClient();
            $driveService = new Drive($client);

            // Get user-specific folder
            $userFolderId = $this->getUserFolder($driveService, $sharedDriveId);

            $file = $request->file('file');

            $fileMetadata = new DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$userFolderId]
            ]);

            $uploadedFile = $driveService->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                    'supportsAllDrives' => true,
                    'fields' => 'id, name, webViewLink, webContentLink'
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

            // Generate public link
            $publicLink = "https://drive.google.com/file/d/{$uploadedFile->getId()}/view";

            return response()->json([
                'success' => true,
                'fileId' => $uploadedFile->getId(),
                'fileName' => $uploadedFile->getName(),
                'publicLink' => $publicLink,
                'viewLink' => $uploadedFile->getWebViewLink()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
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

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);

        } catch (\Exception $e) {
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
                'file' => 'required|file|max:102400'
            ]);

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

            $file = $request->file('file');

            $fileMetadata = new DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$userFolderId]
            ]);

            $uploadedFile = $driveService->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                    'supportsAllDrives' => true,
                    'fields' => 'id, name, webViewLink'
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

            $publicLink = "https://drive.google.com/file/d/{$uploadedFile->getId()}/view";

            return response()->json([
                'success' => true,
                'fileId' => $uploadedFile->getId(),
                'fileName' => $uploadedFile->getName(),
                'publicLink' => $publicLink,
                'viewLink' => $uploadedFile->getWebViewLink()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}