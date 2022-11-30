<?php

namespace App\Http\Livewire\Mant\Fails;

use App\Models\Comment;
use App\Models\Fail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FailCommentList extends Component
{
    public $fail, $comments;

    protected $listeners = ['commentadded' => 'actualizar'];

    public function actualizar(){
        $this->fail->load('comments');
     $this->render();
    }

    public function mount(Fail $fail)
    {   $this->fail = $fail;
        $this->comments = $fail->comments;
    }

    public function remove(Comment $comment){
        $this->fail->comments()->detach($comment);
        $comment->delete();
        $this->fail->load('comments');
        $this->render();
       }

    public function render()
    {
        $this->comments = $this->fail->comments;
        return view('livewire.mant.fails.fail-comment-list');
    }
}
