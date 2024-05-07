<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManage extends Controller
{
    private $param;
    public function index(){
        try{
            $this->param['getAllUsers'] = User::all();
            return view('pages.laravel-examples.user-management', $this->param);
        
        } catch(\Exception $e){
            return redirect()->back()->withErrors('terjadi kesalahan : ', $e->getMessage());

        }catch(\Exception | \Illuminate\Database\QueryException $e){
                return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Status pengguna berhasil diperbarui.');
    }
}
