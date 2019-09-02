<?php

namespace App\Entities\Core;

use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use jeremykenedy\LaravelRoles\Traits\RoleHasRelations;
use jeremykenedy\LaravelRoles\Traits\Slugable;

class Role extends Model implements RoleHasRelationsContract
{
    use Slugable, RoleHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'level', 'status'
    ];

    protected $appends = [
        'deleted', 'cascade'
    ];

    public function getDeletedAttribute () {
        return $this->slug === 'administrator' ? false : true;
    }

    public function getCascadeAttribute () {
        return count($this->user) == 0;
    }

    public function user () {
        return $this->belongsToMany(\App\User::class, 'role_user');
    }

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }
}
