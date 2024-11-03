<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps=false; 
    protected $fillable = [
        'user_id', 'city_id',
        'address_line_1', 'address_line_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   public function country()
    {
        return $this->city->state->country;
    }

    public function state()
    {
        return $this->city->state;
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

