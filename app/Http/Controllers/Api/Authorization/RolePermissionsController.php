<?php

namespace Kouloughli\Http\Controllers\Api\Authorization;

use Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Kouloughli\Events\Role\PermissionsUpdated;
use Kouloughli\Http\Controllers\Api\ApiController;
use Kouloughli\Http\Requests\Role\CreateRoleRequest;
use Kouloughli\Http\Requests\Role\RemoveRoleRequest;
use Kouloughli\Http\Requests\Role\UpdateRolePermissionsRequest;
use Kouloughli\Http\Requests\Role\UpdateRoleRequest;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Role;
use Kouloughli\Transformers\PermissionTransformer;
use Kouloughli\Transformers\RoleTransformer;

/**
 * Class RolePermissionsController
 * @package Kouloughli\Http\Controllers\Api
 */
class RolePermissionsController extends ApiController
{
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
        $this->middleware('auth');
        $this->middleware('permission:permissions.manage');
    }

    public function show(Role $role)
    {
        return $this->respondWithCollection(
            $role->cachedPermissions(),
            new PermissionTransformer
        );
    }

    /**
     * Update specified role.
     * @param Role $role
     * @param UpdateRolePermissionsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Role $role, UpdateRolePermissionsRequest $request)
    {
        $this->roles->updatePermissions(
            $role->id,
            $request->permissions
        );

        event(new PermissionsUpdated);

        return $this->respondWithCollection(
            $role->cachedPermissions(),
            new PermissionTransformer
        );
    }
}
