<?php

namespace App\Http\Livewire\Mant\Timelines;

use App\Models\Comment;
use App\Models\Timeline;
use Livewire\Component;

class TimelineCommentList extends Component
{
    public $timeline, $comments;

    protected $listeners = ['commentadded' => 'actualizar'];

    public function actualizar(){
        $this->timeline->load('comments');
     $this->render();
    }

    public function mount(Timeline $timeline)
    {   $this->timeline = $timeline;
        $this->comments = $timeline->comments;
    }

    public function remove(Comment $comment){
        $this->timeline->comments()->detach($comment);
        $comment->delete();
        $this->timeline->load('comments');
        $this->render();
       }

    public function render()
    {
        $this->comments = $this->timeline->comments;
        return view('livewire.mant.timelines.timeline-comment-list');
    }
}
