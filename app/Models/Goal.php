<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function equipment(){
        return Equipment::find($this->equipment_id)->name;
    }

    public function specialty(){
        return Specialty::find($this->specialty_id)->name;
    }

    public function location(){
        return Equipment::find($this->equipment_id)->location();
    }

    public function replacements(){
        return $this->belongsToMany(Replacement::class)->withPivot('id','price','quantity','total')->withTimestamps();
    }

    public function supplies(){
        return $this->belongsToMany(Supply::class)->withPivot('id','price','quantity','total')->withTimestamps();
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withPivot('id','price','total')->withTimestamps();
    }

    public function teams(){
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

    public function restriction(){
        if($this->restriction){
            return Goal::find($this->restriction)->task;
        }else{
            return ' ';
        }
    }





}
