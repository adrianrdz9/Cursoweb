<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'comment', 'assignment_id', 'comment_id'];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'comment_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment', 'comment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment', 'assignment_id', 'id');
    }

    public function responsesCount(){
        return $this->comments->count();
    }

    public function isResponse(){
        return isset($this->comment_id);
    }
}
