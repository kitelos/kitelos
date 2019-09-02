<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Resources\ModelResource;
use App\Http\Controllers\Controller;

class RuleController extends Controller
{
    /**
     * entity
     *
     * @var \App\Entities\Core\Permission
     */
    protected $entity;

    public function __construct () {
        $this->entity = app(\App\Entities\Core\Permission::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index () {
        $permissions = auth()->user()->getPermissions()
            ->pluck('slug');

        return (new ModelResource($permissions));
    }
}
