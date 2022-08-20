<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'user_id',
        'fine_dinning',
        'fast_food',
        'buffet',
        'cafe',
    ];
       // relationship of user & group is one to many;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
