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

    public function specialty(){
        return Specialty::find($this->specialty_id)->name;
    }

    public function fecha($date){
        return $this->dateStr($date);
    }


}
