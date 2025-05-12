<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Platform</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ route('courses') }}" class="font-bold text-lg">CourseApp</a>
        @auth
            <div class="flex gap-4 items-center">
                <span>Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-blue-500">Logout</button>
                </form>
            </div>
        @else
            <div class="flex gap-4">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        @endauth
    </nav>

    <main class="max-w-4xl mx-auto mt-6 p-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
