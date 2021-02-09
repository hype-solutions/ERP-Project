<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required',

        ],
        [
            'email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'email.unique' => 'برجاء إختيار بريد الكتروني اخر, هذا مستخدم بالفعل',
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
        $users = User::where('id','!=',1)->get();
        return view('users.list',compact('users'));
    }

    public function add()
    {
        $roles = Role::where('name','!=','Super Admin')->get();
        return view('users.add',compact('roles'));
    }

    public function store(Request $request)
    {
        // User::create($this->validatePostRequest());
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->save();
        $user->assignRole($request->role);
        return back()->with('success', 'User Added');
    }

    public function view(User $user)
    {
        if($user->id == 1){
            return redirect()->route('users.list');
        }else{
        return view('users.profile',compact('user'));
        }
    }

    public function edit(User $user)
    {
        $roles = Role::where('name','!=','Super Admin')->get();
        if($user->id == 1){
            return redirect()->route('users.list');
        }else{
        return view('users.edit',compact('user','roles'));
        }
    }


    public function update(Request $request,$user)
    {
        $user = User::find($user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->syncRoles($request->role);
        if(Hash::check($request->password, $user->password)){
            //NO PASS CHANGE
        }else{
            if($request->password == $request->password2 && strlen($request->password) > 3){
                $user->password = Hash::make($request->password);
            }
        }
       $user->save();
      return back()->with('success', 'User Updated');
    }
}
