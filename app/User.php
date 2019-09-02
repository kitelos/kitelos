<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'type', 'status', 'alias', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'deleted', 'rules'
    ];

    public function getDeletedAttribute () {
        return $this->id === 1 ? false : true;
    }

    public function getRulesAttribute () {
        return $this->getPermissions()->pluck('slug');
    }

    public function getAliasAttribute ($value) {
        return $value && strlen($value) > 0 ? $value : $this->email;
    }

    public function getPhotoAttribute ($value) {
        //return $value && strlen($value) > 0 ? value : 'img/user.png';
        return $value != null && strlen($value) > 2 ? \str_contains($value, 'https') ? $value : asset('storage/avatar/'.$value) : asset('img/user.png');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role () {
        return $this->belongsToMany(\App\Entities\Core\Role::class, 'role_user');
    }

    /**
     * Create users for commands
     * 
     * @param array $data
     * @return self
     */
    public function createUser(array $data) : self
    {
        $user = new self($data);

        $user->save();
        
        return $user;
    }
}
