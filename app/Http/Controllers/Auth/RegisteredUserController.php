<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],
            'role'            => ['required', 'in:student,business'],
            'skill_category'  => ['nullable', 'string'],
            'skills'          => ['nullable', 'string'],
            'portfolio_url'   => ['nullable', 'url'],
            'education_level' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => $request->role,
            'skill_category'  => $request->skill_category,
            'skills'          => $request->skills,
            'portfolio_url'   => $request->portfolio_url,
            'education_level' => $request->education_level,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'business') {
            return redirect()->route('internships.create');
        }

        return redirect()->route('dashboard');
    }
}
