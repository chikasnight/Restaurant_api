<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'user_id',
        'table_1',
        'table_2',
        'table_3',
        'table_4',
        'table_5',
        'table_6',
        'table_7',

    ];
       // relationship of user & group is one to many;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
