<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'target_amount', 'link'];

    const UPDATED_AT = null;

    protected $table = 'collections';

    protected function contributors()
    {
        return $this->hasMany(Contributor::class);
    }

    public function scopeFilter($query, string $filter)
    {
        $query->where('target_amount', '<', $filter);
    }
}
