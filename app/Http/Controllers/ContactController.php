<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Handle a contact request.
     */
    public function send(ContactRequest $request): JsonResponse
    {
        dd($request->all());
    }
}
