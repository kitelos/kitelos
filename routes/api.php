<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api'], function () {

    Route::group(['prefix' => 'core', 'namespace' => 'Core'], function () {
        Route::apiResource('users', 'UserController')->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::apiResource('roles', 'RoleController')->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::post('roles/update-permissions/{role}', 'RoleController@updatePermissions');
        Route::get('listroles', 'RoleController@listRoles');

        Route::group(['prefix' => 'permissions'], function () {
            Route::get('/', 'PermissionController@index');
            Route::get('/store', 'PermissionController@store');
        });

        Route::group(['prefix' => 'rules'], function () {
            Route::get('/', 'RuleController@index');
        });

        Route::apiResource('profile', 'ProfileController')->only(['show', 'update', 'store']);
        Route::post('change/password', 'ProfileController@changePassword');

        Route::apiResource('settings', 'SettingController')->except(['create', 'edit']);
    });
    
});
