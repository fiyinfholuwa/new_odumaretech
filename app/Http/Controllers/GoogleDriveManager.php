<?php

namespace App;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class GoogleDriveManager
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(base_path('google-service-account.json')); 
        $this->client->addScope(Google_Service_Drive::DRIVE);

        // Important for Shared Drives
        $this->client->setSubject('storage@odumaretech.com');

        $this->service = new Google_Service_Drive($this->client);
    }

    public function uploadFile($filePath, $fileName, $sharedDriveId, $folderId = null)
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $fileName,
            'parents' => [$folderId ?: $sharedDriveId],
        ]);

        $content = file_get_contents($filePath);

        $file = $this->service->files->create(
            $fileMetadata,
            [
                'data' => $content,
                'mimeType' => mime_content_type($filePath),
                'uploadType' => 'multipart',
                'supportsAllDrives' => true
            ]
        );

        return $file->id;
    }

    public function listFiles($sharedDriveId, $folderId = null)
    {
        $query = $folderId
            ? "'$folderId' in parents"
            : "'$sharedDriveId' in parents";

        $results = $this->service->files->listFiles([
            'q' => $query,
            'supportsAllDrives' => true,
            'includeItemsFromAllDrives' => true,
        ]);

        return $results->getFiles();
    }
}
