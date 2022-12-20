<?php

namespace App\Models;

use App\traits\DateManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory, DateManager;

    protected $guarded = [];

    protected $dates=[
        'start',
        'end',
        'done',
        'work_time',
    ];

    public function equipment(){
        return Equipment::find($this->equipment_id)->name;
    }

    public function specialty(){
        return Specialty::find($this->specialty_id)->name;
    }

    public function location(){
        return Equipment::find($this->equipment_id)->location();
    }

    public function boss(){
        return $teams = Team::where('specialty_id',$this->specialty_id)->get();
    }




    public function assigned(){
return $team = Team::find($this->team_id);

    }

    public function fnReplacements(){
        $goal = Goal::find($this->goal_id);
        return $goal->replacements;
    }

    public function fnServices(){
        $goal = Goal::find($this->goal_id);
        return $goal->services;
    }

    public function fnSupplies(){
        $goal = Goal::find($this->goal_id);
        return $goal->supplies;
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


    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function replacement(){
         $r = Replacement::Find($this->replacement_id);
         if($r){
            return $r->name;
         }
    }

    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }










    public function fecha($date){
        return $this->dateStr($date);
    }


}
