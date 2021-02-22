<?php

namespace App\Http\Controllers;

use App\Models\Settings\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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

            $file = $request->file('setting');
            $fileName = time().'.'.$request->setting->getClientOriginalExtension();

            $folder = public_path("storage/uploads/logos/");
            if (!file::exists($folder)) {
                File::makeDirectory($folder.$request->setting, 0775, true, true);
            }

            if (!empty($file)) {
                    $file->move($folder, $fileName);
            }
            $setting->value = 'storage/uploads/logos/'.$fileName;






            // $request->validate([
            //     'setting' => 'required|mimes:png,jpg,svg,gif|max:2048',
            // ]);

            // $fileName = time().'.'.$request->setting->getClientOriginalExtension();

            // $request->setting->move(public_path('uploads'), $fileName);
            // $setting->value = $fileName;

        }
        $setting->save();
        return back()->with('success', 'updated');
    }
}
