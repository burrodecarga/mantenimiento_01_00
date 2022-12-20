<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Image;
use App\Models\Timeline;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TimelineImages extends Component
{
    public $image_id,$timeline;


    public function mount(Timeline $timeline)
    {
        $this->timeline = $timeline;
    }

    public function delete($imageId){
        $image = Image::find($imageId);
        $file = $image->url;
            $url = str_replace('storage','public',$file);
            Storage::delete($url);
        $image->delete();
        $this->dispatchBrowserEvent('imageAdd');
    }


    public function render()
    {
        return view('livewire.mant.timelines.timeline-images');
    }
}
