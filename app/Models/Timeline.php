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




    public function fecha($date){
        return $this->dateStr($date);
    }


}
