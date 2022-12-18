<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function features(){
        return $this->belongsToMany(Feature::class)->withPivot('id','value');
    }

    public function fails(){
        return $this->hasMany(Fail::class);
    }

    public function location(){
        return Zone::find($this->location)->name;
    }

    public function plans(){
        return $this->belongsToMany(Plan::class)->withTimestamps();
    }


    public function teams($id){
        $plan = Plan::find($id);
        $specialties = $plan->goals->where('equipment_id', $this->id)->unique('specialty_id')->pluck('specialty_id');
        return $teams = Team::whereIn('specialty_id',$specialties)->get();
    }

    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }






}
