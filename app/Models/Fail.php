<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates=[
        'reported_at',
        'repareid_at',
        'assigned_at',
    ];

    // protected $attributes=[
    //     'reported_at'=>'1962-01-17 00:00:00',
    //     'repareid_at'=>'1962-01-17 00:00:00',
    //     'assigned_at'=>'1962-01-17 00:00:00',

    // ];



    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
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


    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }






}
