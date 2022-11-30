<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Comment;
use App\Models\Fail;
use Livewire\Component;

class FailObservation extends Component
{

    public   $fail,$failComments,$observation;

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->failComments = $fail->comments;
    }

    protected $rules=['observation'=>'required',];

    public function saveObservation(){
        $this->validate();
        $comment = new Comment(['comment'=>$this->observation]);
        $this->fail->comments()->save($comment);
        $this->reset('observation');
        $this->failObservation = $this->fail->observaations;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Accion ejecutada',
            'timer'=>1000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

        $this->emitTo('mant.fails.fail-comment-list','commentadded');
    }


    public function render()
    {
        return view('livewire.mant.fails.fail-observation');
    }
}
