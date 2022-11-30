<?php

namespace App\Http\Livewire\Planner;

use App\Models\Protocol;
use App\Models\Prototype;
use Livewire\Component;

class PrototypeProtocols extends Component
{

    public $protocols =[];
    public $search;
    public $prototype,$prototypeProtocolsId;


    public function mount(Prototype $prototype){
      $this->prototype = $prototype;
      $this->prototypeProtocolsId = $prototype->protocols()->pluck('protocols.id')->toarray();
    }

    public function addProtocol($key){
     $this->prototype->protocols()->attach($key);
     $this->prototypeProtocolsId = $this->prototype->protocols()->pluck('protocols.id')->toarray();
     $this->prototype = Prototype::find($this->prototype->id);
     $this->render();
    }

   public function delProtocol(Protocol $protocol){
     $this->prototypeProtocolsId =
     array_filter($this->prototypeProtocolsId, function($key) use ($protocol){
         return $protocol->id !== $key;
     });

    $this->prototype->protocols()->sync($this->prototypeProtocolsId);
    $this->prototype = Prototype::find($this->prototype->id);
    $this->render();
   }


    public function render()
    {
        $search = '%'.$this->search.'%';
        $this->protocols= Protocol::where('detail','like',$search)->whereNotIn('id', $this->prototypeProtocolsId)->pluck('detail','id');
        return view('livewire.planner.prototype-protocols');
    }
}
