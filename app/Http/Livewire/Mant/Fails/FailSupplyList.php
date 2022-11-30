<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FailSupplyList extends Component
{
    public $fail, $supplies;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->fail->load('supplies');
     $this->render();
    }

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->supplies = $fail->supplies;
    }

    public function remove($rfId){
     DB::table('fail_supply')->where('id',$rfId)->delete();
     $this->fail->load('supplies');
     $this->render();
    }

    public function render()
    {
        $this->supplies = $this->fail->supplies;
        return view('livewire.mant.fails.fail-supply-list');
    }
}
