<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends User
{
    public static function booted()
    {
        parent::booting();
        static::addGlobalScope('type', function ($query) {
            $query->where('users.type', 'manager');
        });
    }
    public function employees()
    {
        return $this->hasMany(User::class, 'manager_id')->where('type', 'employee');
    }
}
