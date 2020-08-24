<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Profile;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if (!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view(
            'admin.pages.profiles.permissions.permissions',
            ['profile' => $profile, 'permissions' => $permissions]
        );
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {

        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }
        // dd($request->filter);
        $filters = $request->except('__toker');
        $request->filter;

        $permissions = $profile->permissionsAvailable($request->filter);

        return view(
            'admin.pages.profiles.permissions.available',
            ['profile' => $profile, 'permissions' => $permissions, 'filters' => $filters]
        );
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {

        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()
                ->back()
                ->with('info', 'Necessário escolher pelo menos uma permissão.');
        }

        $request->permissions;
        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {   
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if (!$profile || !$permission) {
            return redirect()->back();
        }


        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function profiles($idPermission)
    {
        
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view(
            'admin.pages.permissions.profiles.profiles',
            ['profiles' => $profiles, 'permission' => $permission]
        );
    }

}