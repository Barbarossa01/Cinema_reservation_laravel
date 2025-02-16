<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    // Specify the exact table name with schema
    protected $table = 'cinema_project_laravel.screening';
    public $timestamps = false;

    // Define the fillable fields
    protected $fillable = ['date', 'time', 'hall', 'film_id', 'available_seats', 'price', 'screen_type'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id');
    }

    public function reservations()
{
    return $this->hasMany(Reservation::class, 'screening_id');}

}
