<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle a contact request.
     */
    public function send(ContactRequest $request): JsonResponse
    {
        Mail::send(new ContactMessage($request->safe()));

        return response()->json([
            'message' => 'Message successfully sent.',
        ]);
    }
}
