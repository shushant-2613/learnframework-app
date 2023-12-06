<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('layouts.app')
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
       
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 50;
}

.pagination-item {
    margin: 0 20px;
}

.pagination-item:not(:last-child) {
    margin-right: 20px;
}

.pagination-item a {
    display: inline-block;
    padding: 20px 20px;
    text-decoration: none;
    color: #3490dc;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.pagination-item a:hover {
    background-color: #3490dc;
    color: #fff;
}

.pagination-item.active a {
    background-color: #3490dc;
    color: #fff;
}

.pagination-item.disabled span {
    display: inline-block;
    padding: 15px 12px;
    color: #ccc;
}

    </style>
</head>
@section('content')
<body class="bg-blue-500 bg-opacity-50 p-4">

    <div class="container">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <!-- <a href="" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a> -->
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


        <!-- User Loop -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">

        @foreach($posts as $post)
            <!-- Post Card -->
            <div class="bg-white p-6 rounded-lg shadow-md" >
                <h2 class="text-xl font-semibold mb-4">Created by {{ $post->user->name }}</h2>

                <!-- Post Loop -->
                <ul>
                    <!-- Post Item -->
                    <li class="mb-2">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- <img src="https://placekitten.com/40/40" alt="Profile" class="w-8 h-8 rounded-full"> -->
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-600 text-sm">{{ $post->postcontent }}</p>
                                
                                <div class="flex flex-col items-center mb-4">
                                    @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="flex flex-col items-center w-4/12 h-auto rounded">
                                    @endif
                                </div>
                                <!-- @if(Auth::user()->name = Auth::user()->name)
                                    <div class="panel-footer break-line">
                                        <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="text-xs btn btn-link orange-400">Edit</a>
                                        <a href="{{ route('comments.create', ['postid' => $post->id]) }}" class="text-xs btn btn-link">Comment</a>
                                    </div>
                                @endif -->

                                <!-- Comment Loop -->
                                @foreach($post->comments as $comment)
                                <ul class="ml-4 mt-2">
                                    <!-- Comment Item -->
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <!-- <img src="https://placekitten.com/30/30" alt="Profile" class="w-6 h-6 rounded-full"> -->
                                        </div>
                                        <div class="ml-2">
                                        
                                            <p class="text-gray-700">{{ $comment->user->name }} said: {{ $comment->commentcontent }}</p>
                                        
                                        </div>
                                    </li>
                                    <!-- End Comment Item -->
                                </ul>
                                @endforeach
                                <!-- End Comment Loop -->

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
    <div class="flex justify-center my-8">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
        <!-- End User Loop -->

    </div>

</body>
@endsection
</html>
