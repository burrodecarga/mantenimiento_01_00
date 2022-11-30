<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalReplacementList extends Component
{
    public $goal, $replacements;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->goal->load('replacements');
     $this->render();
    }

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->replacements = $goal->replacements;
    }

    public function remove($rfId){
     DB::table('goal_replacement')->where('id',$rfId)->delete();
     $this->goal->load('replacements');
     $suma = DB::table('goal_replacement')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_replacement = $suma;
        $this->goal->save();

     $this->render();
    }

    public function render()
    {

        $this->replacements = $this->goal->replacements;
        return view('livewire.mant.goals.goal-replacement-list');
    }
}
