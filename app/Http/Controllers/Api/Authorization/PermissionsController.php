<?php

namespace Kouloughli\Http\Controllers\Api\Authorization;

use Kouloughli\Http\Controllers\Api\ApiController;
use Kouloughli\Http\Requests\Permission\CreatePermissionRequest;
use Kouloughli\Http\Requests\Permission\RemovePermissionRequest;
use Kouloughli\Http\Requests\Permission\UpdatePermissionRequest;
use Kouloughli\Permission;
use Kouloughli\Repositories\Permission\PermissionRepository;
use Kouloughli\Transformers\PermissionTransformer;

/**
 * Class PermissionsController
 * @package Kouloughli\Http\Controllers\Api\Users
 */
class PermissionsController extends ApiController
{
    /**
     * @var PermissionRepository
     */
    private $permissions;

    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
        $this->middleware('auth');
        $this->middleware('permission:permissions.manage');
    }

    /**
     * Get all system permissions.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithCollection(
            $this->permissions->all(),
            new PermissionTransformer
        );
    }

    /**
     * Create new permission from request.
     * @param CreatePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = $this->permissions->create(
            $request->only(['name', 'display_name', 'description'])
        );

        return $this->respondWithItem($permission, new PermissionTransformer);
    }

    /**
     * Get info about specified permission.
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission)
    {
        return $this->respondWithItem($permission, new PermissionTransformer);
    }

    /**
     * Update specified permission.
     * @param Permission $permission
     * @param UpdatePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $input = collect($request->all());

        $permission = $this->permissions->update(
            $permission->id,
            $input->only(['name', 'display_name', 'description'])->toArray()
        );

        return $this->respondWithItem($permission, new PermissionTransformer);
    }

    /**
     * Remove specified permission from storage.
     * @param Permission $permission
     * @param RemovePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission, RemovePermissionRequest $request)
    {
        $this->permissions->delete($permission->id);

        return $this->respondWithSuccess();
    }
}
