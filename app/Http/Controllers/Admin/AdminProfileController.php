<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller, Illuminate\Http\Request, Illuminate\Support\Facades\Auth;
class AdminProfileController extends Controller {
    public function edit(){ return view('admin.profile.edit',['user'=>Auth::user()]); }
    public function update(Request $r){
        $u=Auth::user();
        $u->update($r->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$u->id]));
        return back()->with('success','Profile updated');
    }
public function destroy(Request $request)
{
    // Ambil referensi user saat ini
    $user = Auth::user();

    // Logout dulu
    Auth::logout();

    // Baru hapus user berdasarkan referensi yang sudah diambil
    $user->delete();

    // Bersihkan session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect ke beranda atau halaman lain
    return redirect()->route('home');
}

}