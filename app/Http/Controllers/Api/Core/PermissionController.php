<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Entity
     *
     * @var \App\Entities\Core\Permission
     */
    protected $entity;

    /**
     * Role
     *
     * @var \App\Entities\Core\Permission
     */
    protected $role;

    /**
     * construct
     */
    public function __construct () {
        $this->entity = app(\App\Entities\Core\Permission::class);
        $this->role = app(\App\Entities\Core\Role::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index () {
        $data = $this->entity->all()->groupBy('model');
        return (new ModelResource($data));
    }

    /**
     * Syncronize permission to role
     *
     * @param Request $request
     * @return void
     */
    public function store (Request $request) {
        $role = $this->role->find($request->role);

        if($role) {
            $role->syncPermissions($permissions);
        }

        return (new ModelResource($role))
            ->response()
            ->setStatusCode(201);
    }
}
