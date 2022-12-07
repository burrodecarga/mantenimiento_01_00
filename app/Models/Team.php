<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'cost',
        'user_id',
        'specialty_id',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function specialty(){
       return Specialty::find($this->specialty_id)->name;
    }

    public function zones(){
        return $this->belongsToMany(Zone::class);
    }

    public function fails(){
        return $this->belongsToMany(Fail::class);
    }

    public function goals(){
        return $this->belongsToMany(Goal::class)->withTimestamps();
    }

    public function bossName(){
        $user= User::find($this->user_id);
        if($user){
            return $user->name;
        }else{
            return 'name error';
        }
    }

    public function cost(){
        $cost=0;
        foreach($this->users as $p){

            if($p->profile){
                $cost= $p->profile->salary+$cost;
            }

        }

       $profile = Profile::where('user_id',$this->user_id)->get();
       $salary=0;
       foreach($profile as $p){
        $salary = $p->salary;
       }
        $cost = $salary+$cost;
        return $cost;
    }


}
