<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates=[
        'start',
        'end',
        'start_time',
        'rest_time',
        'work_time'
    ];


    public function equipments(){
        return $this->belongsToMany(Equipment::class)->withTimestamps();
    }

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function workers($str){
        $w = split(',', $str);
        return Team::find($w);
    }

}
