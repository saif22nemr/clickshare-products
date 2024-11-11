<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'type', // enum [ admin]
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
    // public function getImagePathAttribute()
    // {
    //     return empty($this->attributes['image']) ? asset('assets/images/default-user.jpg') : asset('uploads/' . $this->attributes['image']);
    // }
    public function products(){
        return $this->hasMany(Product::class , 'user_id');
    }
}
