<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    protected $drive;

    public function __construct()
    {
        $this->drive = new GoogleDriveManager();
    }

    // Step 1: Get Google Auth URL
    public function getAuthUrl()
    {
        try {
            $url = $this->drive->getAuthUrl();
            return response()->json(['success' => true, 'url' => $url]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Step 2: Handle callback, exchange code for tokens
    public function callback(Request $request)
    {
        try {
            if (!$request->has('code')) {
                return response()->json(['success' => false, 'error' => 'No code provided']);
            }

            $tokens = $this->drive->exchangeCodeForToken($request->code);

            // ⚡ Save refresh_token to .env (or DB). Here we just return it.
            return response()->json(['success' => true, 'tokens' => $tokens]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Upload a file
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file',
            ]);

            $file = $request->file('file');

            $result = $this->drive->upload(
                $file->getRealPath(),
                $file->getClientOriginalName()
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Delete a file
    public function delete($id)
    {
        try {
            $result = $this->drive->delete($id);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // List files
    public function list()
    {
        try {
            $files = $this->drive->list();
            return response()->json($files);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
