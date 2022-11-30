<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $fillable =['name','slug'];

    public function subsystems(){
        return $this->hasMany(Subsystem::class);
    }
}
