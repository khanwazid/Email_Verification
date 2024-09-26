<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps=false; 
    protected $fillable = [
         'address_1', 'address_2', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

