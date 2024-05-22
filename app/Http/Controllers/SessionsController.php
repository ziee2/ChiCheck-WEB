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

    // public function store()
    // {
    //     $attributes = request()->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ],
    //     [
    //         'email.required' => 'Email harus diisi.',
    //         'email.email' => 'Email harus dalam format yang benar.',
    //         'password.required' => 'Password harus diisi.'
    //     ]);
    //     if (! auth()->attempt($attributes)) {
    //         throw ValidationException::withMessages([
    //             'email' => 'Mohon periksa kembali Email dan password Anda'
    //         ]);
    //     }

    //         // Ambil pengguna yang sedang masuk
    //     $user = auth()->user();

    //     // Periksa status akun pengguna
    //     if ($user->status === 'Active') {
    //         // Periksa peran pengguna
    //         if ($user->level === 'Admin') {
    //             // Jika pengguna adalah admin, arahkan ke dashboard admin
    //             return redirect()->route('dashboard-admin');
    //         } elseif ($user->level === 'Owner') {
    //             // Jika pengguna adalah user, arahkan ke dashboard user
    //             return redirect()->route('dashboard');
    //         } else {
    //             // Jika peran tidak dikenali, lempar pengecualian
    //             throw new \Exception('Unknown user role.');
    //         }
    //     } elseif ($user->status === 'Inactive') {
    //         // Jika akun tidak aktif, logout pengguna dan beri pesan kesalahan
    //         auth()->logout();
    //         throw ValidationException::withMessages([
    //             'email' => 'akun ada berstatus inactive, tolong hubungi admin'
    //         ]);
    //     } else {
    //         // Jika status tidak dikenali, lempar pengecualiann
    //         throw new \Exception('Status Tidak Dikenali.');
    //     }
    // }


    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang benar.',
            'password.required' => 'Password harus diisi.'
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (!$user || !Hash::check($attributes['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Mohon periksa kembali Email dan password Anda'
            ]);
        }

        Auth::login($user);

        if ($user->status === 'Active') {
            if ($user->level === 'Admin') {
                return redirect()->route('dashboard-admin');
            } elseif ($user->level === 'Owner') {
                return redirect()->route('dashboard');
            } else {
                throw new \Exception('Unknown user role.');
            }
        } else {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda berstatus inactive, tolong hubungi admin'
            ]);
        }
    }

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ],
        [
            'email.email' => 'Email harus dalam format yang benar.',
            'email.required' => 'Email harus diisi.',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'tautan untuk reset password telah dikirimkan melalui email.'])
                    : back()->withErrors(['email' => 'akun yang anda masukan belum terdaftar']);
                    
        
    }

    public function update(){
        
        request()->validate([
            'token' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'email.email' => 'Email harus dalam format yang benar.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Password tidak sesuai.'
        ]); 

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ]);
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Reset Password Berhasil')
                    : back()->withErrors(['email' => ['Mohon periksa kembali Email dan Password anda']]);
    }
    
    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
