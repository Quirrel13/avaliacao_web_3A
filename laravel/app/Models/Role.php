<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function resource() {
         return $this->belongsToMany('\App\Models\Resource', 'permissions');
    }
}
