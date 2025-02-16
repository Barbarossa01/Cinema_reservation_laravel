<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{


    protected $table = 'cinema_project_laravel.reservation';
    public $timestamps = false;

    protected $fillable = ['screening_id', 'user_id', 'seats'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class, 'screening_id');    }
}
