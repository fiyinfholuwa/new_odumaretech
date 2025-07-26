<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public static function redirectWithMessage(bool $result, string $successMessage, string $failureMessage, string $redirectTo)
    {
        // Determine message and alert type based on the result
        $message = $result ? $successMessage : $failureMessage;
        $alertType = $result ? 'success' : 'error';

        // Determine redirect route or back
        $redirect = $redirectTo === 'back' ? redirect()->back() : redirect()->route($redirectTo);

        // Attach message and alert type to the redirect
        return $redirect->with([
            'message' => $message,
            'alert-type' => $alertType,
        ]);
    }


}
