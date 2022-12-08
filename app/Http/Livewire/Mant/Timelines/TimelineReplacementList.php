<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Timeline;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TimelineReplacementList extends Component
{
    public $timeline, $replacements;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->timeline->load('replacements');
     $this->render();
    }

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->replacements = $timeline->replacements;
    }

    public function remove($rfId){
     DB::table('timeline_replacement')->where('id',$rfId)->delete();
     $this->timeline->load('replacements');
     $this->render();
    }


    public function render()
    {
        $this->replacements = $this->timeline->replacements;
        return view('livewire.mant.timelines.timeline-replacement-list');
    }
}
