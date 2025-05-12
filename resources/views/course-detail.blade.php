<x-app-layout>
    <div class="space-y-4">
        <h2 class="text-2xl font-bold">{{ $course->title }}</h2>
        <p>{{ $course->description }}</p>

        <livewire:enrollments :course="$course" />
        <livewire:comments :course="$course" />
    </div>
</x-app-layout>