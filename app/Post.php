<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['author_id', 'title', 'body'];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

}
