<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototype extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fullName(){
        return $this->name.' '.$this->cha_1.' '.$this->cha_2.' '.$this->cha_3.' '.$this->cha_4;
    }

    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }

    public function features(){
        return $this->belongsToMany(Feature::class);
    }

    public function equipments(){
        return $this->hasMany(Equipment::class);
    }

    public function protocols(){
        return $this->belongsToMany(Protocol::class);
    }

    public function zones(){
        $str = "";
        foreach($this->equipments as $e){
            $str = $e->location().", ".$str;
        }
        return $str;

    }



}
