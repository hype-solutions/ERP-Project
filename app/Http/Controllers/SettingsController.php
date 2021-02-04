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
        return view('settings.landing',compact('settings'));
    }
    public function update(Request $request,Settings $setting)
    {
        $setting->value = $request->setting;
        $setting->save();
        return back()->with('success','updated');
    }
}
