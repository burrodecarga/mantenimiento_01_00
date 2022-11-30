<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prototypes(){
        return $this->belongsToMany(Prototype::class);
    }

    public function specialty(){
        return Specialty::find($this->specialty_id);
    }

    public function typeTask(){
        return Task::find($this->task_id);
    }





}
