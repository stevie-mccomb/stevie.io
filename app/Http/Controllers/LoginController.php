<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->filled('remember_me'))) {
            $request->session()->regenerate();

            return response()->json([
                'user' => auth()->user(),
            ]);
        }

        return response()->json([
            'errors' => [
                'email' => 'The provided credentials do not match our records.',
            ],
        ]);
    }
}
