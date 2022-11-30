<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        "fail" ,
        "equipment" ,
        "type" ,
        "total_replacement" ,
        "total_supply" ,
        "total_service" ,
        "total_workers" ,
               "workers" ,
        "total" ,
        "reported_at" ,
        "assigned_at" ,
        "repareid_at" ,
        "time" ,
        "days" ,
    ];

    protected $dates=[
        'reported_at',
        'repareid_at',
        'assigned_at',
    ];

}
