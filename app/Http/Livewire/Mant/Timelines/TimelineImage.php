<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Timeline;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TimelineImage extends Component
{
    use WithFileUploads;

    public $file, $url, $description,$timeline;

    public function mount(Timeline $timeline){
        $this->timeline = $timeline;
    }

    protected $rules = ['file' => 'image|max:2048|mimes:jpg,png,jpeg'];

    public function save(){
        $this->validate();
            $temp = $this->file->store('public/timelines');
             $url = Storage::url($temp);
             $this->timeline->images()->create([
                'url'=>$url,
                'description'=>mb_strtolower($this->description)
             ]);

             $this->reset('file');
             $this->dispatchBrowserEvent('imageAdd');

        }


    public function render()
    {
        return view('livewire.mant.timelines.timeline-image');
    }
}
