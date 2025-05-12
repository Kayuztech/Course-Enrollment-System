<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class Enrollments extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function enroll()
    {
        $user = Auth::user();

        if (!$user->enrollments()->where('course_id', $this->course->id)->exists()) {
            $user->enrollments()->create([
                'course_id' => $this->course->id,
            ]);
            session()->flash('message', 'Enrolled successfully!');
        }

        return redirect()->route('courses');
    }

    public function cancel()
    {
        $user = Auth::user();

        $user->enrollments()->where('course_id', $this->course->id)->delete();

        session()->flash('message', 'Enrollment cancelled.');
        return redirect()->route('courses');
    }

    public function render()
    {
        $enrolled = Auth::user()->enrollments()->where('course_id', $this->course->id)->exists();

        return view('livewire.enrollments', [
            'enrolled' => $enrolled,
        ]);
    }
}
