<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Supply;
use App\Models\Timeline;
use Livewire\Component;

class TimelineSupply extends Component
{
    public $timeline, $timelineSupply, $supplies;
    public $supplyId, $quantity;

    protected $rules=[
        'supplyId'=>'required',
        'quantity'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->timelineSupply = $timeline->supplies;
        //dd($this->timelineRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->supply = Supply::find($this->supplyId);
        $price = $this->supply->price;
        $total = $this->supply->price * $this->quantity;
        $quantity = $this->quantity;
       $this->supply->timelines()->attach($this->timeline->id,[
            'price'=>$price,
            'quantity'=>$quantity,
            'total'=>$total
        ]);

        $this->reset('quantity','supplyId');
        $this->timelineSupply = $this->timeline->supplies;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emitTo('mant.timelines.timeline-supply-list','replacemetadded');

    }

    public function render()
    {
        $this->supplies = Supply::orderBy('name')->get();
        return view('livewire.mant.timelines.timeline-supply');
    }
}
