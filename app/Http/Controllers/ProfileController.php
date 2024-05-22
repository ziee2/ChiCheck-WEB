<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\desa;
use App\Models\kecamatan;
use App\Models\kabupaten;
use App\Models\provinsi;



class ProfileController extends Controller
{
    public function create()
    {
        

    //     // $desas = Desa::all();
    //     // $kecamatans = Kecamatan::all();
    //     // $kabupatens = Kabupaten::all();
    //     // $provinsis = Provinsi::all();

        return view('pages.profile');
    //     // return view('pages.profile', compact('desas', 'kecamatans', 'kabupatens', 'provinsis'));
    }
    public function viewedit()
    {
        try {
            $data['provinsis'] = Provinsi::all();
            if ($data['provinsis']->isEmpty()) {
                $data['isEmpty'] = true;
            }
            return view('pages.laravel-examples.user-profile', $data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error','Terjadi kesalahan: ' . $e->getMessage());
        }

        
    }
    
    public function update(Request $request)
    {
        $user = $request->user();
        $attributes = $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required',
            'no_hp' => 'required|max:13',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'provinsi_id' => 'required|exists:provinsis,id',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'desa_id' => 'required|exists:desas,id',
        ]);

        // Proses unggah foto profil
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/profile_pictures/' . $user->image);
            }
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/profile_pictures', $filename);
            $attributes['image'] = $filename;
        }

        // Cari atau buat desa, kecamatan, kabupaten, dan provinsi
        // $desa = Desa::firstOrCreate(['nama' => $request->desa]);
        // $kecamatan = Kecamatan::firstOrCreate(['nama' => $request->kecamatan]);
        // $kabupaten = Kabupaten::firstOrCreate(['nama' => $request->kabupaten]);
        // $provinsi = Provinsi::firstOrCreate(['nama' => $request->provinsi]);

        // // Set _id dari relasi ke attributes
        // $attributes['desa_id'] = $desa->id;
        // $attributes['kecamatan_id'] = $kecamatan->id;
        // $attributes['kabupaten_id'] = $kabupaten->id;
        // $attributes['provinsi_id'] = $provinsi->id;

        // Update user profile
        $user->update($attributes);

        return back()->withStatus('Data Akun Berhasil diubah.');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',

        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($request->password); // Meng-hash password baru sebelum disimpan
        $user->save();

        event(new PasswordReset($user));

        // $request->validate([
        //     'current_password' => 'required',
        //     'new_password' => 'required|min:8',
        //     'confirm_password' => 'required|same:new_password',
        // ]);

        // $user = auth()->user();

        // if (!Hash::check($request->current_password, $user->password)) {
        //     return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        // }

        // $user->update([
        //     'password' => Hash::make($request->new_password),
        // ]);
        return back()->withStatus('password berhasil diubah.');
        // return redirect()->route('user-profile')->withStatus('Password has been changed successfully.');
    }


    
    // public function getKabupatens(Request $request, $provinsi_id)
    // {
    //     $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)->get();
    //     return response()->json($kabupatens);
    // }
    // public function getKecamatans(Request $request, $kabupaten_id)
    // {
    //     $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
    //     return response()->json($kecamatans);
    // }
    // public function getDesas(Request $request, $kecamatan_id)
    // {
    //     $desas = Desa::where('kecamatan_id', $kecamatan_id)->get();
    //     return response()->json($desas);
    // }
    public function getKabupatens($provinsi_id) {
        $kabupatens = kabupaten::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kabupatens);
    }
    
    public function getKecamatans($kabupaten_id) {
        $kecamatans = kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
    
    public function getDesas($kecamatan_id) {
        $desas = desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desas);
    }
    

}
