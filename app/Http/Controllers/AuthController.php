<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create()
    {
        return inertia(
            "Auth/login"
        );
    }

    public function store(Request $request)
    {
        $isValid = $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string|'
            ]
        );

        // dd(
        // [
        // Hash::check($isValid['password'],User::find(1)->password),
        // User::find(1)->password,
        // Hash::make($isValid['password']),
        // ]

        // );



        $isSuccess = Auth::attempt(
            $isValid,
            true,
        );

        $request->session()->regenerate();
        if (!$isSuccess) {

            throw ValidationException::withMessages(
                [
                    'email' => 'Authentication Failed',
                    'password' => 'Authentication Failed'
                ]
            );
        }
        return redirect()->intended('/listing');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(route('listing.index'));
    }
}
