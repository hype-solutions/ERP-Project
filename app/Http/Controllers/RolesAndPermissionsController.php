<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public function roles()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get()->pluck('name');
        return view('settings.roles', compact('roles'));
    }

    public function addingRoles(Request $request)
    {
        Role::create(['name' => $request->role_name]);
        return back();
    }

    public function permissions($role_name)
    {
        $allPermissions = Permission::all();
        $role = Role::findByName($role_name);
        $permissions = $role->permissions()->get();
        App::setLocale('ar');
        return view('settings.permissions', compact('allPermissions', 'role', 'permissions', 'role_name'));
    }

    public function addingPermissions(Request $request)
    {
        Permission::create(['name' => $request->permission_name]);
        return back();
    }

    public function assignPermissionToRole(Role $role, Permission $permission)
    {
        $permission->assignRole($role);
    }


    public function reSyncRolewithPermissions(Request $request)
    {
        $role = Role::findByName($request->role);
        $permissions = $request->permission;
        $permissionsArray = [];
        foreach ($permissions as $per) {
            $permission = Permission::findByName($per['name']);
            if (isset($per['status'])) {
                $permissionsArray[] = $permission;
            }
        }
        $role->syncPermissions($permissionsArray);
        return back();
    }


    public function assignUserToRole(User $user, Role $role)
    {
        $user->assignRole($role->name);
    }
}
