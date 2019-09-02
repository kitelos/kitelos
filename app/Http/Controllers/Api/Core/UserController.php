<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Entity
     *
     * @var \App\User
     */
    protected $entity;

    public function __construct() {
        $this->entity = app(\App\User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index () {
        permiss ( 'user.list' );

        $data = $this->entity
            ->with(['role'])
            ->where('id', '<>', \Auth::id())
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
        permiss ( 'user.show' );

        $data = $this->entity->with(['role'])
            ->find($id);

        return (new ModelResource($data))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Core\UserStoreRequest $request
     * @return void
     */
    public function store (\App\Http\Requests\Core\UserStoreRequest $request) {
        permiss ( 'user.create' );

        $user = $this->entity->create([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'status'    =>  $request->status,
            'password'  =>  bcrypt('password')
        ]);

        $user->syncRoles($request->role);

        return (new ModelResource($user))
            ->response()
            ->setStatusCode(202);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Core\UserUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update (\App\Http\Requests\Core\UserUpdateRequest $request, $id) {
        permiss ( 'user.edit' );

        $user = $this->entity->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();

        if ( $request->role != null && $request->role != 'null' )
            $user->syncRoles(is_string($request->role) ? explode(',', $request->role) : $this->ids($request->role) );
        else 
            $user->detachAllRoles();
        
        return (new ModelResource($user))
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
        permiss ( 'user.delete' );

        $user = $this->entity->find($id);
        if ( $user->delete() )
            return response()->json([
                'code'  =>  204,
                'data'  =>  'deleted user'
            ]);
        
        return response()->json([
            'code'  =>  500,
            'data'  =>  'error to deleted user'
        ]);
    }

    private function ids($data) {
        $id = array();
        foreach ( $data as $item ) {
            $id[] = json_decode($item, true)['id'];
        }
        return $id;
    }
}
