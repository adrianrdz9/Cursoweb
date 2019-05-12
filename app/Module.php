<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($module_id)
 */
class Module extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'hours', 'evaluation'];

    public function teachers()
    {
        $moduleTeachers = ModuleTeacher::where(
            'module_id', '=', $this->id
        )->get(['teacher_id']);

        $ids = [];

        foreach ($moduleTeachers as $mt) {
            array_push($ids, $mt->teacher_id);
        }

        return User::whereIn('id', $ids)->get();  
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'module_id', 'id');
    }
}
