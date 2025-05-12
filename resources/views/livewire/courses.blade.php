<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Courses</h1>

    <div class="mb-4">
        <select wire:model="filter" class="border rounded p-2">
            <option value="all">All Courses</option>
            <option value="enrolled">Enrolled Courses</option>
            <option value="not_enrolled">Not Enrolled</option>
        </select>
    </div>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Date Added</th>
                <th class="px-4 py-2">Comments</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $course->title }}</td>
                    <td class="border px-4 py-2">{{ $course->description }}</td>
                    <td class="border px-4 py-2">{{ $course->created_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">{{ $course->comments_count }}</td>
                    <td class="border px-4 py-2">
                        @if($course->enrollments->where('user_id', auth()->id())->count())
                            <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 text-white px-2 py-1 rounded">View</a>
                            <a href="{{ route('enroll', $course) }}" class="bg-red-500 text-white px-2 py-1 rounded">Cancel</a>
                        @else
                            <a href="{{ route('enroll', $course) }}" class="bg-green-500 text-white px-2 py-1 rounded">Enroll</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
