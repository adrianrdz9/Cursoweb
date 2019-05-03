<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'assignment_id', 'comment', 'link'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment', 'assignment_id', 'id');
    }
}
