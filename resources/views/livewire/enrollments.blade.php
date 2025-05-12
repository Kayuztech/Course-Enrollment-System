<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Manage Enrollment for: {{ $course->title }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if ($enrolled)
        <button wire:click="cancel" class="bg-red-600 text-white px-4 py-2 rounded">Cancel Enrollment</button>
    @else
        <button wire:click="enroll" class="bg-green-600 text-white px-4 py-2 rounded">Enroll Now</button>
    @endif

    <div class="mt-6">
        <a href="{{ route('courses') }}" class="text-blue-500 underline">← Back to Courses</a>
    </div>
</div>
