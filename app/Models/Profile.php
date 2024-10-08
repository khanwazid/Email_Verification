<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'username', 
    ];
     public function address(){
        return $this->hasMany(Address::class);
     }
}
