<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsystem extends Model
{
    use HasFactory;


    protected $fillable =['name','slug','system_id'];

    public function system(){
        return $this->belongsTo(System::class);
    }
}
