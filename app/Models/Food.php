<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'description',
        'image',
        'upload_successful',
        'disk',
    ];
       // relationship of user & group is one to many;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
