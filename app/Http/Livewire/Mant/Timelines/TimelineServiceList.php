<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Timeline;
use Livewire\Component;

class TimelineServiceList extends Component
{
    public $timeline, $services;

    protected $listeners = ['serviceadded' => 'actualizar'];

    public function actualizar(){
        $this->timeline->load('services');
     $this->render();
    }

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->services = $timeline->services;
    }

    public function remove($rfId){
     DB::table('timeline_service')->where('id',$rfId)->delete();
     $this->timeline->load('services');
     $this->render();
    }

    public function render()
    {
        $this->services = $this->timeline->services;
        return view('livewire.mant.timelines.timeline-service-list');
    }
}
