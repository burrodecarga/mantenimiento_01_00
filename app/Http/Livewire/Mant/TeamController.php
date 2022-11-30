<?php

namespace App\Http\Livewire\Mant;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TeamController extends Component
{
    public $search, $cost=0;
    public $team,$teamUsers, $teamUsersId,$teamsUsersId=[];
    public $users=[];

    public function mount(Team $team){

        $this->team = $team;
        $this->teamUsersId = $team->users()->pluck('users.id')->toarray();
      }

      public function addPersonal($userId){
        $this->team->users()->attach($userId);
        $this->team = Team::find($this->team->id);
        $this->teamUsers = $this->team->users;
        $this->teamsUsersId = DB::table('team_user')->pluck('user_id');

      }

      public function delPersonal($userId){
        $this->team->users()->detach($userId);
        $this->team = Team::find($this->team->id);
        $this->teamUsers = $this->team->users;
        $this->teamsUsersId = DB::table('team_user')->pluck('user_id');

      }

    public function render()
    {


        $this->teamUsers = $this->team->users;
        $user_id = collect($this->team->user_id);
        $this->teamsUsersId = DB::table('team_user')->pluck('user_id');
        $this->teamUsersId = $this->team->users()->pluck('users.id')->toarray();

        $costId = $user_id->concat($this->teamUsersId);

        $this->cost = Profile::whereIn('id',$costId)->sum('salary');
         $search = '%'.$this->search.'%';
        $this->users= User::where('name','like',$search)->whereNotIn('id', $this->teamsUsersId)->pluck('name','id');
        return view('livewire.mant.team-controller');
    }
}
