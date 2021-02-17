<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $role = Role::findByName($role_name);
        $permissions = $role->permissions()->get();
        return view('settings.permissions', compact('role', 'permissions'));
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

    public function assignUserToRole(User $user, Role $role)
    {
        $user->assignRole($role->name);
    }
}
