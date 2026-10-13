<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login', [
            'seoTitle' => 'Austin Optics Admin Login',
            'seoDescription' => 'Admin login.',
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $emails = collect(config('austin.admin_emails'))->map(fn ($email) => strtolower($email))->all();
        $configuredPassword = config('austin.admin_password');

        try {
            $bcryptMatches = $configuredPassword ? Hash::check($data['password'], $configuredPassword) : false;
        } catch (\Throwable) {
            $bcryptMatches = false;
        }

        $passwordMatches = $configuredPassword && (
            $bcryptMatches || hash_equals($configuredPassword, $data['password'])
        );

        if (! in_array(strtolower($data['email']), $emails, true) || ! $passwordMatches) {
            throw ValidationException::withMessages([
                'email' => 'Invalid admin credentials.',
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('austin_admin', [
            'email' => strtolower($data['email']),
        ]);

        return redirect()->route('admin.seo.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('austin_admin');
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
