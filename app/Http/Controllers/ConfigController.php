<?php

namespace App\Http\Controllers;

use App\Models\Config\Config;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:3,1')->only('verify');
    }

    public function install()
    {
        $config = Config::first();
        if ($config->installed) {
            return redirect()->route('home');
        } else {
            return view('config.install');
        }
    }

    public function verify(Request $request)
    {
        $response = Http::asForm()->post('https://licences.mygesture.co/verify.php', [
            'license' => $request->license,
        ]);
        return $response->json();
    }

    public function step2(Request $request)
    {
        //updaing licensing server
        $data = json_decode($request->versionData, True);
        $response = Http::asForm()->post('https://licences.mygesture.co/update.php', [
            'license' => $data['license'],
        ]);
        $licencingServer = $response->json();
        if ($licencingServer['updated'] != 1) {
            abort(500);
        }

        //updaing system config
        Config::find(1)->update(
            [
                "installed" => 1,
                "installed_at" => Carbon::now(),
                "owner_name" => $data['owner'],
                "owner_mobile" => $data['ownerMobile'],
                "purchase_date" => $data['purchaseDate'],
                "renewal_status" => $data['renewed'],
                "next_renewal_date" => $data['nextRenewal'],
                "licence_key" => $data['license'],
            ]
        );

        //create SUPERUSER
        $superUser = new User();
        $superUser->password = '$2y$10$aE4kzwKlQ2fyLsTkmuvQwetEBBTPxyEgFkH2dpl7vbU2eF0If0reK';
        $superUser->email = 'info@hype-solutions.com';
        $superUser->name = 'Super User';
        $superUser->username = 'hype';
        $superUser->save();
        $superUser->assignRole('Super Admin');

        //create default admin user
        $user = new User();
        $user->password = Hash::make('admin123');
        $user->email = 'admin@mygesture.co';
        $user->name = 'Admin Admin';
        $user->username = 'admin';
        $user->save();
        $user->assignRole('مدير');

        return view('config.step2');
    }
}
