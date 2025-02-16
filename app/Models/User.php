<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'cinema_project_laravel.users';

    protected $fillable = ['email', 'password', 'first_name', 'last_name'];

    protected $hidden = ['password'];

    public $timestamps = false;



    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }

    public function isAdmin()
{
    return $this->hasOne(Administrator::class, 'user_id')->exists();
}

}