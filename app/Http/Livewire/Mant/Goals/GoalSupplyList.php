<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalSupplyList extends Component
{
    public $goal, $supplies;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->goal->load('supplies');
     $this->render();
    }

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->supplies = $goal->supplies;
    }

    public function remove($rfId){
     DB::table('goal_supply')->where('id',$rfId)->delete();
     $this->goal->load('supplies');
     $suma = DB::table('goal_supply')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_supply = $suma;
        $this->goal->save();

     $this->render();
    }

    public function render()
    {
        $this->supplies = $this->goal->supplies;
        return view('livewire.mant.goals.goal-supply-list');
    }
}
