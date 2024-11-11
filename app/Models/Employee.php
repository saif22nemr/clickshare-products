<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends User
{

    public static function booted(){
        parent::booting();
        static::addGlobalScope('type' , function($query){
            $query->where('users.type' , 'employee');
        });
    }
}
