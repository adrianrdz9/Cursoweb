<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Delivery;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['deadline', 'title', 'description', 'example', 'type', 'module_id'];

    protected $cast = [
        'deadline' => 'datetime'
    ];

    public function delivered(){
        if(auth()->check()){
            return Delivery::where([
                ['user_id', auth()->user()->id],
                ['assignment_id', $this->id]
            ])->exists();
        }else{
            throw new Error("No se puede verificar si una tarea fue enviada si no se inició sesión");
        }
    }

    public function deliveredAt(){
        if(auth()->check()){
            return Carbon::createFromFormat('Y-m-d H:i:s', Delivery::where([
                ['user_id', auth()->user()->id],
                ['assignment_id', $this->id]
            ])->first()->updated_at);
        }else{
            throw new Error("No se puede verificar la hora de envio si no se inició sesión");
        }
    }

    public function delivery(){
        if(auth()->check()){
            return Delivery::where([
                ['user_id', auth()->user()->id],
                ['assignment_id', $this->id]
            ])->first();
        }else{
            throw new Error("No se puede obtener una entrega si no se ha iniciado sesión");
        }
    }
    
    public function deliveries()
    {
        return $this->hasMany('App\Delivery', 'assignment_id', 'id');
    }

    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'id');
    }
}
