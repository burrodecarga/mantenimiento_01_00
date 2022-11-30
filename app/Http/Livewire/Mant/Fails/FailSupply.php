<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use App\Models\Supply;
use Livewire\Component;

class FailSupply extends Component
{
    public $fail, $failSupply, $supplies;
    public $supplyId, $quantity;

    protected $rules=[
        'supplyId'=>'required',
        'quantity'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->failSupply = $fail->supplies;
        //dd($this->failRemplacements);
    }

    public function saveReplacement(){
        $this->validate();

        $this->supply = Supply::find($this->supplyId);
        $price = $this->supply->price;
        $total = $this->supply->price * $this->quantity;
        $quantity = $this->quantity;
       $this->supply->fails()->attach($this->fail->id,[
            'price'=>$price,
            'quantity'=>$quantity,
            'total'=>$total
        ]);

        $this->reset('quantity','supplyId');
        $this->failSupply = $this->fail->supplies;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emitTo('mant.fails.fail-supply-list','replacemetadded');

    }


    public function render()
    {
        $this->supplies = Supply::orderBy('name')->get();
        return view('livewire.mant.fails.fail-supply');
    }
}
