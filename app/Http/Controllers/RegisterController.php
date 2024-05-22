<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(){

        $attributes = request()->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ],
        [
            'username.required' => 'Username harus diisi',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang benar.',
            'password.required' => 'Password harus diisi.'
        ]);

        User::create($attributes);
        // auth()->login($user);
        
        return redirect('/sign-in')->with('status', 'Registrasi Berhasil');
        // return redirect()->route('user-profile')->withStatus('Password has been changed successfully.');
        // return redirect()->back()->with('status', 'Data berhasil diperbarui');
    } 
}
