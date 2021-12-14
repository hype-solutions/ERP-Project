<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|unique:users',
                'username' => 'required|unique:users',
                'mobile' => 'numeric|required|unique:users',
                'password' => 'required',
                'role' => 'required',

            ],
            [
                'email.email' => 'برجاء إدخال بريد الكتروني صحيح',
                'email.unique' => 'برجاء إختيار بريد الكتروني اخر, هذا مستخدم بالفعل',
                'mobile.numeric' => 'رقم التليفون يقبل أرقام فقط',
                'mobile.required' => 'برجاء إدخال رقم موبايل المستخدم',
                'mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
                'username.required' => 'برجاء إدخال رقم موبايل المستخدم',
                'username.unique' => 'برجاء إختيار اسم مستخدم اخر',
                'password.required' => 'برجاء إدخال كلمة السر',
                'name.required' => 'برجاء إدخال الإسم الحقيقي للمستخدم',

            ]
        );
    }
    public function usersList()
    {
        if (request()->ajax()) {
            $users = User::where('id', '!=', 1)->with('roles')->get();
            return datatables()->of($users)->make(true);
        }

        $users = User::where('id', '!=', 1)->with('roles')->get();
        return view('users.list', compact('users'));
    }

    public function add()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($this->validatePostRequest());

        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();
        // $user = new User();
        // $user->password = Hash::make($request->password);
        // $user->email = $request->email;
        // $user->name = $request->name;
        // $user->username = $request->username;
        // $user->mobile = $request->mobile;
        // $user->role = $request->role;
        // $user->save();
        $user->assignRole($request->role);
        return back()->with('success', 'User Added');
    }

    public function view(User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('users.list');
        } else {
            return view('users.profile', compact('user'));
        }
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        if ($user->id == 1) {
            return redirect()->route('users.list');
        } else {
            return view('users.edit', compact('user', 'roles'));
        }
    }


    public function update(Request $request, $user)
    {
        $user = User::find($user);

        $check = User::where('email', $request->email)->where('id','!=',$user->id)->count();
        if($check > 0){
            return back()->with('error', 'xxx');
        }else{
            $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        if ($request->role != 'change') {
            $user->role = $request->role;
            $user->syncRoles($request->role);
        }


        if (Hash::check($request->password, $user->password)) {
            //NO PASS CHANGE
        } else {
            if ($request->password == $request->password2 && strlen($request->password) > 3) {
                $user->password = Hash::make($request->password);
            }
        }
        $user->save();
        return back()->with('success', 'User Updated');
        }

    }


    public function delete(User $user)
    {
        User::destroy($user->id);
        return back()->with('success', 'User Deleted');
    }

    public function profilepic(User $user, Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|mimes:png,jpg,svg,gif|max:2048',
        ]);
        $file = $request->file('profile_pic');
        $fileName = time() . '.' . $request->profile_pic->getClientOriginalExtension();

        $folder = "users/" . $user->id . "/p";
        if (!Storage::disk('erp')->exists($folder)) {
            Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
        }
        if (!empty($file)) {
            Storage::disk('erp')->put($folder . '/' . $fileName, File::get($request->profile_pic));
        }
        $user->profile_pic = 'uploads/users/' . $user->id . '/p/' . $fileName;
        $user->save();
        return back();
    }

    public function signature(User $user, Request $request)
    {
        $request->validate([
            'signature' => 'required|mimes:png,jpg,svg,gif|max:2048',
        ]);
        $file = $request->file('signature');
        $fileName = time() . '.' . $request->signature->getClientOriginalExtension();

        $folder = "users/" . $user->id . "/s";
        if (!Storage::disk('erp')->exists($folder)) {
            Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
        }
        if (!empty($file)) {
            Storage::disk('erp')->put($folder . '/' . $fileName, File::get($request->signature));
        }
        $user->signature = 'uploads/users/' . $user->id . '/s/' . $fileName;
        $user->save();
        return back();
    }

    public function permissions(User $user)
    {
        $allPermissions = Permission::all();
        $permissions = $user->permissions()->get();
        App::setLocale('ar');
        return view('users.permissions', compact('allPermissions', 'user', 'permissions'));
    }

    public function reSyncRolewithPermissions(Request $request)
    {
        $user = User::find($request->user_id);
        $user->roles()->detach();


        $permissions = $request->permission;
        $permissionsArray = [];
        foreach ($permissions as $per) {
            $permission = Permission::findByName($per['name']);
            if (isset($per['status'])) {
                $permissionsArray[] = $permission;
            }
        }

        $user->syncPermissions($permissionsArray);
        return back();
    }

    public function ajax(Request $request)
    {
        $user = User::find($request->userId);
        return $user;
    }

    // function sendResetPassword(User $user){
    //     $status = Password::sendResetLink(
    //         $user->email
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //                 ? back()->with(['status' => __($status)])
    //                 : back()->withErrors(['email' => __($status)]);
    // }

    public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    return back()->with('success', "Reset Sent");
}
}
