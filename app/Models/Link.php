<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    protected $table = "links";
    protected $fillable = [
       'user_id',
        'name',
        'original_link',
        'shorten_link',
        'visited',
        'created_at',
        'updated_at'
    ];

}
