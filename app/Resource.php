<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'type', 'description', 'link', 'attachment'];
}
