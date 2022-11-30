<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use App\Models\Service;
use Livewire\Component;

class FailService extends Component
{
    public $fail, $failService, $services;
    public $serviceId, $price;

    protected $rules=[
        'serviceId'=>'required',
        'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->failRemplacements = $fail->service;
        //dd($this->failRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->service = Service::find($this->serviceId);
        $price = $this->service->price;
        $total = $this->price;
       $this->service->fails()->attach($this->fail->id,[
            'price'=>$price,
            'total'=>$total
        ]);

        $this->reset('price','serviceId');
        $this->failService = $this->fail->service;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

        $this->emitTo('mant.fails.fail-service-list','serviceadded');

    }
    public function render()
    {
        $this->services = Service::orderBy('name')->get();
        return view('livewire.mant.fails.fail-service');
    }
}
