<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;

class GoogleDriveController extends Controller
{
    protected function googleClient()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
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

    public function index(Request $request)
    {
        // Set your Shared Drive Folder URL HERE
        $sharedDriveUrl = "https://drive.google.com/drive/folders/0AEC82CMaKw77Uk9PVA";
        $sharedDriveId = $this->extractDriveId($sharedDriveUrl);

        // Initialize Google Client + Drive
        $client = $this->googleClient();
        $driveService = new Drive($client);

        // Handle file upload
        if ($request->isMethod('post') && $request->hasFile('file')) {
            $file = $request->file('file');

            $fileMetadata = new Drive\DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$sharedDriveId]
            ]);

            $driveService->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                    'supportsAllDrives' => true
                ]
            );
        }

        // List files in shared drive
        $results = $driveService->files->listFiles([
            'driveId' => $sharedDriveId,
            'includeItemsFromAllDrives' => true,
            'supportsAllDrives' => true,
            'corpora' => 'drive',
        ]);

        $files = $results->getFiles();

        return view('google-drive', compact('files'));
    }
}
