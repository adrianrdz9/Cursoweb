<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

use App\Module;

class User extends Authenticatable
{
    use HasRoles;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'account_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function deliveries()
    {
        return $this->hasMany('App\Delivery', 'user_id', 'id');
    }

    public function modules()
    {
        $modules = [];

        $moduleTeacher = ModuleTeacher::where('teacher_id', $this->id)->with('module')->get();

        foreach ($moduleTeacher as $modT) {
            array_push($modules, $modT->module);
        }

        return $modules;
    }

    public function teachModule($mid){
        foreach($this->modules as $m){
            if($m->id == $mid) return true;
        }

        return false;
    }


}
