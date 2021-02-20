<?php

namespace App\Http\Controllers;

use App\Models\Settings\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('installed');
        $this->middleware('auth');
    }

    public function settings()
    {
        $settings = Settings::all();
        return view('settings.landing', compact('settings'));
    }
    public function update(Request $request, Settings $setting)
    {
        if($setting->key != 'logo'){
        $setting->value = $request->setting;
        }else{
            $request->validate([
                'setting' => 'required|mimes:png,jpg,svg,gif|max:2048',
            ]);

            $fileName = time().'.'.$request->setting->getClientOriginalExtension();

            $request->setting->move(public_path('uploads'), $fileName);
            $setting->value = $fileName;

        }
        $setting->save();
        return back()->with('success', 'updated');
    }
}
