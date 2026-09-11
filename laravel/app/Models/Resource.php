<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public function role() {
        return $this->belongsToMany('\App\Models\Role', 'permissions');
    }
}
