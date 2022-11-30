<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use App\Models\Replacement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FailReplacementList extends Component
{
    public $fail, $replacements;

    protected $listeners = ['replacemetadded' => 'actualizar'];

    public function actualizar(){
        $this->fail->load('replacements');
     $this->render();
    }

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->replacements = $fail->replacements;
    }

    public function remove($rfId){
     DB::table('fail_replacement')->where('id',$rfId)->delete();
     $this->fail->load('replacements');
     $this->render();
    }

    public function render()
    {

        $this->replacements = $this->fail->replacements;
        return view('livewire.mant.fails.fail-replacement-list');
    }
}
