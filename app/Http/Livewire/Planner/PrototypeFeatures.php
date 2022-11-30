<?php

namespace App\Http\Livewire\Planner;

use App\Models\Feature;
use App\Models\Prototype;
use Livewire\Component;

class PrototypeFeatures extends Component
{
   public $features =[];
   public $search;
    public $prototype,$prototypeFeaturesId;
   public function mount(Prototype $prototype){
     $this->prototype = $prototype;
     $this->prototypeFeaturesId = $prototype->features()->pluck('features.id')->toarray();
   }

   public function addFeature($key){
    $this->prototype->features()->attach($key);
    $this->prototypeFeaturesId = $this->prototype->features()->pluck('features.id')->toarray();
    $this->prototype = Prototype::find($this->prototype->id);
    $this->render();
   }

  public function delFeature(Feature $feature){
    $this->prototypeFeaturesId =
    array_filter($this->prototypeFeaturesId, function($key) use ($feature){
        return $feature->id !== $key;
    });

   $this->prototype->features()->sync($this->prototypeFeaturesId);
   $this->prototype = Prototype::find($this->prototype->id);
   $this->render();
  }



    public function render()
    {
       $search = '%'.$this->search.'%';
        $this->features= Feature::where('measure','like',$search)->whereNotIn('id', $this->prototypeFeaturesId)->pluck('resume','id');
       return view('livewire.planner.prototype-features');
    }
}
