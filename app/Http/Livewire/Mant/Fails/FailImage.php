<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Fail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FailImage extends Component
{
    use WithFileUploads;

    public $file, $url, $description,$fail;

    public function mount(Fail $fail){
        $this->fail = $fail;
    }

    protected $rules = ['file' => 'image|max:2048|mimes:jpg,png,jpeg'];

    public function save(){
        $this->validate();
            $temp = $this->file->store('public/fails');
             $url = Storage::url($temp);
             $this->fail->images()->create([
                'url'=>$url,
                'description'=>mb_strtolower($this->description)
             ]);

             $this->reset('file');
             $this->dispatchBrowserEvent('imageAdd');

        }


    public function render()
    {
        return view('livewire.mant.fails.fail-image');
    }
}
