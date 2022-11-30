<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalSupply extends Component
{
    public $goal, $goalSupply, $supplies;
    public $supplyId, $quantity;

    protected $rules=[
        'supplyId'=>'required',
        'quantity'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->goalSupply = $goal->supplies;
        //dd($this->goalRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->supply = Supply::find($this->supplyId);
        $price = $this->supply->price;
        $total = $this->supply->price * $this->quantity;
        $quantity = $this->quantity;
       $this->supply->goals()->attach($this->goal->id,[
            'price'=>$price,
            'quantity'=>$quantity,
            'total'=>$total
        ]);
        $suma = DB::table('goal_supply')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_supply = $suma;
        $this->goal->save();


        $this->reset('quantity','supplyId');
        $this->goalSupply = $this->goal->supplies;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emitTo('mant.goals.goal-supply-list','replacemetadded');

    }


    public function render()
    {
        $this->supplies = Supply::orderBy('name')->get();
        return view('livewire.mant.goals.goal-supply');
    }
}
