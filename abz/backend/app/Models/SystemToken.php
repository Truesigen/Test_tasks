<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SystemToken extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'expires_at'];

    public function createToken(): string
    {
        $tokenText = Str::random(64);

        $token = base64_encode($tokenText);

        $this->create(['name' => $token, 'expires_at' => now()->addMinutes(40)]);

        return $token;
    }

    public function deleteToken(string $token): void
    {
        $this->where('name', $token)->first()->delete();
    }
}
