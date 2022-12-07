<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Comment;
use App\Models\Timeline;
use Livewire\Component;

class TimelineObservation extends Component
{
    public   $timeline,$timelineComments,$observation;

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->timelineComments = $timeline->comments;
    }

    protected $rules=['observation'=>'required',];

    public function saveObservation(){
        $this->validate();
        $comment = new Comment(['comment'=>$this->observation]);
        $this->timeline->comments()->save($comment);
        $this->reset('observation');
        $this->timelineObservation = $this->timeline->observaations;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

        $this->emitTo('mant.timelines.timeline-comment-list','commentadded');
    }

    public function render()
    {
        return view('livewire.mant.timelines.timeline-observation');
    }
}
