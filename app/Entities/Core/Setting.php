<?php

namespace App\Entities\Core;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key', 'value'
    ];

    protected $appends = [
        'deleted'
    ];

    public function getDeletedAttribute () {
        return true;
    }
}
