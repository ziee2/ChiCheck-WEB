<?php

namespace App\Http\Controllers;

Use Str;
Use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

            // Ambil pengguna yang sedang masuk
        $user = auth()->user();

        // Periksa status akun pengguna
        if ($user->status === 'active') {
            // Periksa peran pengguna
            if ($user->role === 'admin') {
                // Jika pengguna adalah admin, arahkan ke dashboard admin
                return redirect()->route('dashboard');
            } elseif ($user->role === 'user') {
                // Jika pengguna adalah user, arahkan ke dashboard user
                return redirect()->route('dashboard');
            } else {
                // Jika peran tidak dikenali, lempar pengecualian
                throw new \Exception('Unknown user role.');
            }
        } elseif ($user->status === 'inactive') {
            // Jika akun tidak aktif, logout pengguna dan beri pesan kesalahan
            auth()->logout();
            throw ValidationException::withMessages([
                'email' => 'Your account is inactive. Please contact support for assistance.'
            ]);
        } else {
            // Jika status tidak dikenali, lempar pengecualian
            throw new \Exception('Unknown account status.');
        }
    


        // // Periksa peran pengguna
        // if ($user->role === 'admin') {
        //     // Jika pengguna adalah admin, arahkan ke dashboard admin
        //     return redirect()->route('dashboard');
        // } elseif ($user->role === 'user') {
        //     // Jika pengguna adalah user, arahkan ke dashboard user
        //     return redirect()->route('dashboard');
        // }

        // // session()->regenerate();

        // // return redirect('/dashboard');
        // throw new \Exception('Unknown user role.');

    }

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
        
    }

    public function update(){
        
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]); 
          
        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    
    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
