<div class="p-6">
    <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
    <p class="text-gray-700 mb-4">{{ $course->description }}</p>
    <p class="text-sm text-gray-500 mb-6">Duration: {{ $course->duration }}</p>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        <form wire:submit.prevent="postComment">
            <textarea wire:model="commentMessage" rows="3" class="w-full p-2 border rounded" placeholder="Write your comment..."></textarea>
            @error('commentMessage') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Post Comment</button>
        </form>
    </div>

    <h2 class="text-lg font-semibold mb-2">Comments</h2>

    @forelse ($comments as $comment)
        <div class="border-b border-gray-200 py-2">
            <p class="text-gray-800">{{ $comment->message }}</p>
            <p class="text-xs text-gray-500">
                By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y h:i A') }}
            </p>
            @if ($comment->user_id === auth()->id())
                <button wire:click="deleteComment({{ $comment->id }})" class="text-red-500 text-sm">Delete</button>
            @endif
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse
</div>
