<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Timeline;
use Livewire\Component;

class TimelineSupplyList extends Component
{
    public $timeline, $supplies;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->timeline->load('supplies');
     $this->render();
    }

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->supplies = $timeline->supplies;
    }

    public function remove($rfId){
     DB::table('timeline_supply')->where('id',$rfId)->delete();
     $this->timeline->load('supplies');
     $this->render();
    }

    public function render()
    {
        $this->supplies = $this->timeline->supplies;
        return view('livewire.mant.timelines.timeline-supply-list');
    }
}
