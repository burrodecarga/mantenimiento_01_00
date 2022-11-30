<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use App\Models\Replacement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalReplacement extends Component
{

    public $goal, $goalReplacements, $replacements;
    public $replacementId, $quantity;

    protected $rules=[
        'replacementId'=>'required',
        'quantity'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->goalRemplacements = $goal->replacements;
    }

    public function saveReplacement(){
        $this->validate();

        $this->replacement = Replacement::find($this->replacementId);
        $price = $this->replacement->price;
        $total = $this->replacement->price * $this->quantity;
        $quantity = $this->quantity;
       $this->replacement->goals()->attach($this->goal->id,[
            'price'=>$price,
            'quantity'=>$quantity,
            'total'=>$total
        ]);

        $suma = DB::table('goal_replacement')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_replacement = $suma;
        $this->goal->save();

        $this->reset('quantity','replacementId');
        $this->goalReplacements = $this->goal->replacements;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);


        $this->emitTo('mant.goals.goal-replacement-list','replacemetadded');
    }

    public function render()
    {
        $this->replacements = Replacement::orderBy('name')->get();
        return view('livewire.mant.goals.goal-replacement');
    }
}
