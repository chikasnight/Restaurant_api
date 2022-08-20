<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable = [
        'user_id',
        'anonymous',
        'admin',
        'members',
        'staff',
    ];
       // relationship of user & group is one to many;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
