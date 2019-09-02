<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Entity
     *
     * @var \App\Entities\Core\Setting
     */
    protected $entity;

    public function __construct() {
        $this->entity = app(\App\Entities\Core\Setting::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index () {
        permiss ( 'setting.list' );

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
        permiss ( 'setting.show' );

        $data = $this->entity
            ->find($id);

        return (new ModelResource($data))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Core\SettingStoreRequest $request
     * @return void
     */
    public function store (\App\Http\Requests\Core\SettingStoreRequest $request) {
        permiss ( 'setting.create' );

        $setting = $this->entity->create([
            'key'  =>  $request->key,
            'value' =>  $request->value
        ]);

        return (new ModelResource($setting))
            ->response()
            ->setStatusCode(202);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Core\SettingUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update (\App\Http\Requests\Core\SettingUpdateRequest $request, $id) {
        permiss ( 'setting.edit' );

        $user = $this->entity->find($id);
        $user->update([
            'key'   =>  $request->key,
            'value' =>  $request->value,
        ]);

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
        permiss ( 'setting.delete' );

        $user = $this->entity->find($id);
        
        if ( $user->delete() ) 
            return response()->json([
                'code'  =>  204,
                'data'  =>  'deleted setting'
            ]);

        return response()->json([
            'code'  =>  500,
            'data'  =>  'Error to deleted setting'
        ]);
    }
}
