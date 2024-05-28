<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Provinsi;



class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
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
            'provinsi_id' => 'required|exists:provinsi,id',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
        ],[
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang benar.',
            'username.required' => 'username harus diisi',
            'no_hp.required' => 'nomor handphone harus diisi',
            'image.image' => 'image tidak valid',
            'provinsi_id.required' => 'provinsi harus diisi',
            'kabupaten_id.required' => 'kabupaten harus diisi',
            'kecamatan_id.required' => 'kecamatan harus diisi',
            'desa_id.required' => 'desa harus diisi',

        ]);

        // Proses unggah foto profil
        // if ($request->hasFile('image')) {
        //     if ($user->image) {
        //         Storage::delete('public/storage/profile_pictures/' . $user->image);
        //     }
        //     $filename = time() . '.' . $request->image->extension();
        //     $request->image->storeAs('public/storage/profile_pictures', $filename);
        //     $attributes['image'] = $filename;
        // }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete('profile_pictures/' . $user->image);
            }
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('profile_pictures', $filename, 'public');
            $attributes['image'] = $filename;
        }

        // Cari atau buat desa, kecamatan, kabupaten, dan provinsi
        // $desa = Desa::firstOrCreate(['nama' => $request->desa]);
        // $kecamatan = Kecamatan::firstOrCreate(['nama' => $request->kecamatan]);
        // $kabupaten = Kabupaten::firstOrCreate(['nama' => $request->kabupaten]);
        // $provinsi = Provinsi::firstOrCreate(['nama' => $request->provinsi]);

        // Set _id dari relasi ke attributes
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

        $user->password = $request->password; 
        $user->save();

        event(new PasswordReset($user));

        return back()->withStatus('password berhasil diubah.');
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
        $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kabupatens);
    }
    
    public function getKecamatans($kabupaten_id) {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
    
    public function getDesas($kecamatan_id) {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desas);
    }
    

}
