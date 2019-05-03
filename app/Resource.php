<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'type', 'description', 'link', 'attachment'];
}
