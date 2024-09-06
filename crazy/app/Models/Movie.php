<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = ['name', 'is_published', 'preview_image'];

    protected function previewImage(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return asset('storage/movies/preview/'.$value);
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_movies', 'movie_id', 'category_id');
    }
}
