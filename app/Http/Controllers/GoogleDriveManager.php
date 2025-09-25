<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Drive;

class GoogleDriveManager
{
    protected $client;
    protected $service;

    public function __construct($withAuth = true)
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope(Drive::DRIVE);

        if ($withAuth && env('GOOGLE_REFRESH_TOKEN')) {
            $this->client->refreshToken(env('GOOGLE_REFRESH_TOKEN'));
            $this->service = new Drive($this->client);
        }
    }

    public function getAuthUrl()
    {
        $this->client->setAccessType('offline');   // get refresh token
        $this->client->setPrompt('consent');       // force consent
        return $this->client->createAuthUrl();
    }

    public function exchangeCodeForToken($code)
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function upload($localPath, $fileName, $parentId = null)
    {
        try {
            $fileMetadata = new Drive\DriveFile([
                'name'    => $fileName,
                'parents' => $parentId ? [$parentId] : []
            ]);

            $file = $this->service->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($localPath),
                    'uploadType' => 'multipart',
                    'fields' => 'id, webViewLink, webContentLink'
                ]
            );

            return [
                'success'       => true,
                'file_id'       => $file->id,
                'view_link'     => $file->webViewLink,
                'download_link' => $file->webContentLink,
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function delete($fileId)
    {
        try {
            $this->service->files->delete($fileId);
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function list()
    {
        try {
            $files = $this->service->files->listFiles([
                'fields' => 'files(id, name, webViewLink)'
            ]);
            return ['success' => true, 'files' => $files->files];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
