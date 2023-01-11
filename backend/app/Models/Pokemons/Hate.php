<?php

namespace App\Models\Pokemons;

use App\Models\Pokemons\Pokemon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
