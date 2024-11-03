<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
    public function addresses()
    {
        return $this->hasManyThrough(Address::class, State::class, 'country_id', 'city_id', 'id', 'id');
    }
}

