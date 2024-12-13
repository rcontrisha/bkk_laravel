<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Arahkan berdasarkan peran pengguna
        $user = $request->user();

        if ($user->role === 'mitra') {
            return redirect()->route('lowongan.data'); // Redirect untuk pengguna Mitra
        } elseif ($user->role === 'Admin') {
            return redirect()->route('dashboard'); // Redirect untuk Admin
        } else {
            return redirect()->route('index.show'); // Redirect untuk peran lainnya
        }
    }

    /**
     * Handle an incoming authentication request for API.
     */

    public function apiStore(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        // Ambil instance User yang sedang login
        $user = User::find(Auth::id());

        return response()->json([
            'message' => 'Login successful',
            'user' => $user, // Mengembalikan data pengguna sesuai kebutuhan
            'token' => $user->createToken('YourAppName')->plainTextToken, // Token jika menggunakan Laravel Sanctum
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
