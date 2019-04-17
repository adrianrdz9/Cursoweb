<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
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
