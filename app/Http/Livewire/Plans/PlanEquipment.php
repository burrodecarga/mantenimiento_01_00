<?php

namespace App\Http\Livewire\Plans;

use App\Models\Equipment;
use App\Models\Plan;
use Livewire\Component;

class PlanEquipment extends Component
{

    public $plan;
    public $equipments;
    public $planEquipmetsId;
    public  $search;

    public function mount(Plan $plan){
        $this->plan = $plan;
        $this->equipments = Equipment::orderBy('location')->get();
        $this->planEquipmetsId = $this->plan->equipments()->pluck('equipment.id')->toarray();
      }

      public function addEquipment($key){
        $this->plan->equipments()->attach($key);
        $this->planEquipmetsId = $this->plan->equipments()->pluck('equipment.id')->toarray();
        $this->plan = Plan::find($this->plan->id);
        $this->render();
       }

       public function delEquipment($key){
        $this->plan->equipments()->detach($key);
        $this->planEquipmetsId = $this->plan->equipments()->pluck('equipment.id')->toarray();
        $this->plan = Plan::find($this->plan->id);
        $this->render();
       }






    public function render()
    {
        $search = '%'.$this->search.'%';
        $this->equipments= Equipment::
        where('name','like',$search)
        ->whereNotIn('id', $this->planEquipmetsId)->get();
        return view('livewire.plans.plan-equipment');
    }
}
