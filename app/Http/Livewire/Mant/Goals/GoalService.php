<?php

namespace App\Http\Livewire\Mant\Goals;

use App\Models\Goal;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GoalService extends Component
{
    public $goal, $goalService, $services;
    public $serviceId, $price;

    protected $rules=[
        'serviceId'=>'required',
        'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Goal $goal)
    {   $this->goal = $goal;
        $this->goalRemplacements = $goal->service;
        //dd($this->goalRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->service = Service::find($this->serviceId);
        $price = $this->service->price;
        $total = $this->price;
       $this->service->goals()->attach($this->goal->id,[
            'price'=>$price,
            'total'=>$total
        ]);

        $suma = DB::table('goal_service')
                  ->where('goal_id',$this->goal->id)
                  ->sum('total');
        $this->goal->total_service = $suma;
        $this->goal->save();

        $this->reset('price','serviceId');
        $this->goalService = $this->goal->service;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

        $this->emitTo('mant.goals.goal-service-list','serviceadded');

    }
    public function render()
    {
        $this->services = Service::orderBy('name')->get();
        return view('livewire.mant.goals.goal-service');
    }
}
