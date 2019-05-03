<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleTeacher extends Model
{
    use SoftDeletes;

    protected $fillable = ['module_id', 'teacher_id'];
}
