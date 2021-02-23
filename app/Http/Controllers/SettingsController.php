<?php

namespace App\Http\Controllers;

use App\Models\Settings\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            $file = $request->file('setting');
            $fileName = time().'.'.$request->setting->getClientOriginalExtension();

            $folder = "logos/";
            if (!Storage::disk('erp')->exists($folder)) {
                Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
            }
            if (!empty($file)) {
                    Storage::disk('erp')->put($folder.'/'.$fileName, File::get($request->setting));
            }
            $setting->value = 'uploads/logos/'.$fileName;
            $setting->save();
           return back();


        }
        $setting->save();
        return back()->with('success', 'updated');
    }
}
