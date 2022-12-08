<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fails(){
        return $this->belongsToMany(Fail::class)->withPivot('id','price','quantity','total')->withTimestamps();
    }

    public function goals(){
        return $this->belongsToMany(Goal::class)->withPivot('id','price','quantity','total')->withTimestamps();
    }

    public function timelines(){
        return $this->belongsToMany(Timeline::class)->withPivot('id','price','quantity','total')->withTimestamps();
    }


}
