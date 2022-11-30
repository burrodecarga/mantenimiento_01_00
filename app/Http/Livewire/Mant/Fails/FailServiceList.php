<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FailServiceList extends Component
{
    public $fail, $services;

    protected $listeners = ['serviceadded' => 'actualizar'];

    public function actualizar(){
        $this->fail->load('services');
     $this->render();
    }

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->services = $fail->services;
    }

    public function remove($rfId){
     DB::table('fail_service')->where('id',$rfId)->delete();
     $this->fail->load('services');
     $this->render();
    }

    public function render()
    {
        $this->services = $this->fail->services;
        return view('livewire.mant.fails.fail-service-list');
    }
}
