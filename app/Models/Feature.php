<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function prototypes(){
        return $this->belongsToMany(Prototype::class);
    }

    public function equipments(){
        return $this->belongsToMany(Equipment::class)->withPivot('id','value');
    }



}
