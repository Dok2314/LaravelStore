<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'api_token'];

    public function createToken()
    {
        $token = Str::random(60);
        $this->api_token = $token;
        $this->save();

        return $token;
    }
}
