<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Service;
use App\Models\Timeline;
use Livewire\Component;

class TimelineService extends Component
{
    public $timeline, $timelineService, $services;
    public $serviceId, $price;

    protected $rules=[
        'serviceId'=>'required',
        'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->timelineRemplacements = $timeline->service;
        //dd($this->timelineRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->service = Service::find($this->serviceId);
        $price = $this->service->price;
        $total = $this->price;
       $this->service->timelines()->attach($this->timeline->id,[
            'price'=>$price,
            'total'=>$total
        ]);

        $this->reset('price','serviceId');
        $this->timelineService = $this->timeline->service;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

        $this->emitTo('mant.timelines.timeline-service-list','serviceadded');

    }
    public function render()
    {
        $this->services = Service::orderBy('name')->get();
        return view('livewire.mant.timelines.timeline-service');
    }
}
