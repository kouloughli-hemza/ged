<?php

namespace Kouloughli\Http\Controllers\Web\Authorization;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Kouloughli\Events\Role\PermissionsUpdated;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Repositories\Role\RoleRepository;

/**
 * Class RolePermissionsController
 * @package Kouloughli\Http\Controllers
 */
class RolePermissionsController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roles;

    /**
     * RolePermissionsController constructor.
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $roles = $request->get('roles');

        $allRoles = $this->roles->lists('ref_role');

        foreach ($allRoles as $roleId) {
            $permissions = Arr::get($roles, $roleId, []);
            $this->roles->updatePermissions($roleId, $permissions);
        }

        event(new PermissionsUpdated);

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permissions saved successfully.'));
    }
}
