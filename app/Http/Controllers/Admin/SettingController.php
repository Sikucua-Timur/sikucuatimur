<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller, App\Models\Setting, Illuminate\Http\Request;
class SettingController extends Controller {
    public function edit(){ return view('admin.setting.edit',['setting'=>Setting::first()]); }
    public function update(Request $r){ Setting::first()->update($r->validate(['site_name'=>'nullable','alamat'=>'nullable','email'=>'nullable|email','telepon'=>'nullable'])); return back(); }
}
