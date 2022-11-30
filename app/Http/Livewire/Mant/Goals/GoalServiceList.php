<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalServiceList extends Component
{
    public $goal, $services;

    protected $listeners = ['serviceadded' => 'actualizar'];

    public function actualizar(){
        $this->goal->load('services');
     $this->render();
    }

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->services = $goal->services;
    }

    public function remove($rfId){
     DB::table('goal_service')->where('id',$rfId)->delete();
     $this->goal->load('services');
     $suma = DB::table('goal_service')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_service = $suma;
        $this->goal->save();

     $this->render();
    }

    public function render()
    {
        $this->services = $this->goal->services;
        return view('livewire.mant.goals.goal-service-list');
    }
}
