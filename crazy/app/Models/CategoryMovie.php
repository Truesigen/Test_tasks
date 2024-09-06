<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMovie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category_movies';

    protected $fillable = ['movie_id', 'category_id'];
}
