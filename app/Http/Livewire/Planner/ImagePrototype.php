<?php

namespace App\Http\Livewire\Planner;

use App\Models\Prototype;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImagePrototype extends Component
{
    use WithFileUploads;

    public $file, $url, $description,$prototype;

    public function mount(Prototype $prototype){
        $this->prototype = $prototype;
    }

    protected $rules = ['file' => 'image|max:2048|mimes:jpg,png,jpeg'];

    public function save(){
        $this->validate();
            $temp = $this->file->store('public/prototypes');
             $url = Storage::url($temp);
             $this->prototype->images()->create([
                'url'=>$url,
                'description'=>mb_strtolower($this->description)
             ]);
             return redirect()->route('prototypes.index')->with('success','Imagen creada correctamente');
        }

    public function render()
    {
        return view('livewire.planner.image-prototype');
    }
}
