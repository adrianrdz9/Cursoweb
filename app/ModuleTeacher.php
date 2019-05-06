<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleTeacher extends Model
{
    use SoftDeletes;

    protected $fillable = ['module_id', 'teacher_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'teacher_id', 'id');
    }   

    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'id');
    }
}
