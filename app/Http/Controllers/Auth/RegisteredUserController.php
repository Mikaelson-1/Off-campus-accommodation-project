<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ── Base validation ─────────────────────────────────────────────────
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone'    => ['nullable', 'string', 'max:20'],
            'role'     => ['required', 'in:student,landlord'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Student-specific
            'matriculation_number' => [
                'required_if:role,student',
                'nullable',
                'string',
                'max:50',
                'unique:students,matriculation_number',
            ],
        ], [
            'matriculation_number.required_if' => 'Matriculation number is required for student accounts.',
            'matriculation_number.unique'       => 'This matriculation number is already registered.',
        ]);

        // ── Create User ──────────────────────────────────────────────────────
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // ── Create Role-Specific Profile ─────────────────────────────────────
        if ($request->role === 'student') {
            Student::create([
                'user_id'              => $user->id,
                'matriculation_number' => strtoupper(trim($request->matriculation_number)),
            ]);
        } elseif ($request->role === 'landlord') {
            Landlord::create([
                'user_id'             => $user->id,
                'verification_status' => 'pending',
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // ── Role-Based Redirect ──────────────────────────────────────────────
        return match ($user->role) {
            'landlord' => redirect()->route('landlord.dashboard'),
            default    => redirect()->route('student.dashboard'),
        };
    }
}
