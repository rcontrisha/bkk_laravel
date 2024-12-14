<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Mitra;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,mitra,user'], // Validasi pilihan role
            'company_name' => ['required_if:role,mitra', 'string', 'max:255'], // Nama perusahaan wajib jika role mitra
            'company_location' => ['required_if:role,mitra', 'string', 'max:255'], // Lokasi perusahaan wajib jika role mitra
        ]);

        // Buat user baru di table users
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // Pastikan kolom role ada di table users
        ]);

        // Jika role adalah mitra, buat data di table mitra
        if ($validated['role'] === 'mitra') {
            Mitra::create([
                'id_user' => $user->id, // Hubungkan user baru dengan mitra
                'perusahaan' => $validated['company_name'],
                'lokasi' => $validated['company_location'],
            ]);
        }

        // Trigger event pendaftaran
        event(new Registered($user));

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'mitra') {
            return redirect()->route('lowongan.data')->with('success', 'Selamat datang di dashboard mitra!');
        } elseif ($user->role === 'admin') {
            return redirect(RouteServiceProvider::FORM)->with('success', 'Registration successful!');
        }

        // Default untuk role user
        return redirect(RouteServiceProvider::HOME)->with('success', 'Registration successful!');
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Trigger event for new registered user, if necessary
        event(new Registered($user));

        // Optional: auto-login user after registration
        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }
}
