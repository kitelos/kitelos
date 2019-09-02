<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * entity
     *
     * @var \App\User
     */
    protected $entity;

    public function __construct () {
        $this->entity = app(\App\User::class);
    }

    /**
     * Show profile User Auth
     *
     * @param [type] $id
     * @return void
     */
    public function show ($id) {
        permiss ( 'user.profile' );

        $data = $this->entity->with(['role'])
            ->find($id);

        return (new ModelResource($data))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Core\ProfileRequest $request
     * @param [type] $id
     * @return void
     */
    public function update (\App\Http\Requests\Core\ProfileRequest $request, $id) {
        permiss ( 'user.profile' );

        $user = $this->entity->with(['role'])->find($id);
        $user->update([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'alias'     =>  $request->alias,
            'bio'       =>  $request->bio
        ]);
        
        return (new ModelResource($user))
            ->response()
            ->setStatusCode(203);
    }

    /**
     * Uplaod image avatar user
     *
     * @param Request $request
     * @return void
     */
    public function store (Request $request) {
        permiss ( 'user.profile' );
        if (!$request->hasFile('avatar')) {
            return response()->json([
                'success' => false,
                'error' => 'no file found.',
            ]);
        }

        $file = $request->file('avatar');
        $name = \Auth::user()->alias;
        $path = '/public/avatar/';
        $extension = $file->getClientOriginalExtension();
        $full_name = $name . '.' . $extension;

        $user = \App\User::find(\Auth::id());
        $user->update([
            'photo' =>  $full_name
        ]);
        $imagethumb = \Image::make($file);
        
        $imagethumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();                 
        });

        $imagethumb->stream();
        
        if ( \Storage::disk('local')->put($path.$full_name, $imagethumb, 'public') )
            return response()->json([
                'url'   =>  url('/').'/storage/avatar/'.$full_name
            ]);

        return response()
            ->setStatusCode(404);
    }

    /**
     * Change password to user login
     *
     * @param \App\Http\Requests\Core\PasswordUpdateRequest $request
     * @return void
     */
    public function changePassword (\App\Http\Requests\Core\PasswordUpdateRequest $request) {
        permiss( 'user.profile' );

        $user = $this->entity->find( \Auth::id() );

        $user->update([
            'password'  =>  bcrypt($request->password),
        ]);
        
        return (new ModelResource($user))
            ->response()
            ->setStatusCode(205);
    }
}
