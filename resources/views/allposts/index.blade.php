<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </div>

    <div class="container mx-auto p-8">

        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

        <!-- User Loop -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">

        @foreach($posts as $post)
            <!-- Post Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Created by {{ $post->user->name }}</h2>

                <!-- Post Loop -->
                <ul>
                    <!-- Post Item -->
                    <li class="mb-2">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img src="https://placekitten.com/40/40" alt="Profile" class="w-8 h-8 rounded-full">
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-600 text-sm">{{ $post->postcontent }}</p>
                            </div>
                        </div>
                    </li>
                    <!-- End Post Item -->

                    <!-- Add more posts and comments as needed -->

                </ul>
                <!-- End Post Loop -->

            </div>
            <!-- End Post Card -->

            <!-- Add more user cards as needed -->
        @endforeach
        </div>
        <!-- End User Loop -->

    </div>

</body>

</html>
