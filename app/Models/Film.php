<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Specify the exact table name with schema
    protected $table = 'cinema_project_laravel.film'; // Use schema.table_name format

    // Define fillable fields for mass assignment
    protected $fillable = ['title', 'description', 'category', 'duration','image'];
    public $timestamps = false; // Disable automatic timestamps


    public function screenings()
{
    return $this->hasMany(Screening::class);
}
}
