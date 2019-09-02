<?php

namespace App\Http\Controllers\Api\Core;

use App\Entities\Core\Role;
use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Role
     *
     * @var \App\Entities\Core\Role
     */
    protected $entity;

    /**
     * Constructor
     */
    public function __construct () {
        $this->entity = app(Role::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index () {
        permiss ( 'role.list' );

        $data = $this->entity
        ->orderBy('created_at', 'desc')->get();

        return new ModelResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show ($id) {
        permiss ( 'role.show' );

        $role = $this->entity->find($id);

        return $data = $this->orderPermissions($role, $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (\App\Http\Requests\Core\RoleStoreRequest $request) {
        permiss ( 'role.create' );

        $role = $this->entity->create([
            'name'  =>  $request->name,
            'slug'  =>  $request->slug,
            'level' =>  $request->level,
            'description'   =>  $request->description
        ]);

        return (new ModelResource($role))
            ->response()
            ->setStatusCode(202);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Core\RoleUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update (\App\Http\Requests\Core\RoleUpdateRequest $request, $id) {
        permiss ( 'role.edit' );

        $role = $this->entity->find($id);

        $role->update([
            'name'  =>  $request->name,
            'slug'  =>  $request->slug,
            'level' =>  $request->level,
            'description'   =>  $request->description,
        ]);

        return (new ModelResource($role))
            ->response()
            ->setStatusCode(203);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy ($id) {
        permiss ( 'role.delete' );

        $role = $this->entity->find($id);
        
        if ( $role->cascade && $role->delete() ) {
            return response()->json([
                'code'  =>  204,
                'data'  =>  'deleted user'
            ]);
        }

        return response()->json([
            'code'  =>  500,
            'data'  =>  'Error to deleted role'
        ]);
    }

    public function updatePermissions (Request $request, Role $role) {
        $permissions = explode(',', $request->permissions);
        $role->syncPermissions($permissions);

        return (new ModelResource($permissions))
            ->response()
            ->setStatusCode(205);
    }

    private function orderPermissions ($role, $iteration) {
        $permissions = $iteration->permissions->map(function ($item) {
            return $item->id;
        });

        return [
            'data'  =>  $role,
            'permissions'   =>  $permissions
        ];
    }
}
