<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Replacement;
use App\Models\Timeline;
use Livewire\Component;

class TimelineReplacement extends Component
{
    public $timeline, $timelineReplacements, $replacements;
    public $replacementId, $quantity;

    protected $rules=[
        'replacementId'=>'required',
        'quantity'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->timelineRemplacements = $timeline->replacements;
        //dd($this->timelineRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->replacement = Replacement::find($this->replacementId);
        $price = $this->replacement->price;
        $total = $this->replacement->price * $this->quantity;
        $quantity = $this->quantity;
       $this->replacement->timelines()->attach($this->timeline->id,[
            'price'=>$price,
            'quantity'=>$quantity,
            'total'=>$total
        ]);

        $this->reset('quantity','replacementId');
        $this->timelineReplacements = $this->timeline->replacements;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);


 $this->emitTo('mant.timelines.timeline-replacement-list','replacemetadded');
    }

    public function render()
    {
$this->replacements = Replacement::orderBy('name')->get();

        return view('livewire.mant.timelines.timeline-replacement');
    }
}
