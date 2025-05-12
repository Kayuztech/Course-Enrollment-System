<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class Courses extends Component
{
    use WithPagination;

    public $filter = 'all'; // all, enrolled, not_enrolled

    public function render()
    {
        $user = Auth::user();

        $query = Course::withCount('comments');

        if ($this->filter === 'enrolled') {
            $query->whereHas('enrollments', fn($q) => $q->where('user_id', $user->id));
        } elseif ($this->filter === 'not_enrolled') {
            $query->whereDoesntHave('enrollments', fn($q) => $q->where('user_id', $user->id));
        }

        $courses = $query->paginate(10);

        return view('livewire.courses', [
            'courses' => $courses,
        ]);
    }
}
