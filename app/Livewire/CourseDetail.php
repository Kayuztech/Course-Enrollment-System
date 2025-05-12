<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CourseDetail extends Component
{
    public Course $course;
    public string $commentMessage = '';

    public function mount(Course $course)
    {
        // Enforce policy
        $this->authorize('view', $course);
        $this->course = $course;
    }

    public function postComment()
    {
        $this->validate([
            'commentMessage' => 'required|string|max:500',
        ]);

        Comment::create([
            'course_id' => $this->course->id,
            'user_id' => Auth::id(),
            'message' => $this->commentMessage,
        ]);

        $this->reset('commentMessage');
        session()->flash('message', 'Comment posted!');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id === Auth::id()) {
            $comment->delete();
            session()->flash('message', 'Comment deleted.');
        }
    }

    public function render()
    {
        return view('livewire.course-detail', [
            'comments' => $this->course->comments()->latest()->get(),
        ]);
    }
}
