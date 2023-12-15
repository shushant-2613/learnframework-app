<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

<body class="bg-blue-200 bg-opacity-50 p-4">
    <div class="flex items-center justify-center">
        <h1 class="text-4xl font-bold">Admin Login Page</h1>
    </div>
    <div class="container mb-5 ">
            @if (Route::has('login'))
                <div class="mb-40 sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
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
        <div class=" bg-white border border-gray-300 p-4 rounded-lg shadow-md animate-slide-in grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">

        @foreach($posts as $post)
            <!-- Post Card -->
            <div class="border border-gray-300 flex flex-col bg-gray-100 rounded-lg items-center overflow-hidden shadow-md w-full max-w-md mb-4" >
                <h2 class="font-semibold text-gray-700">Created by {{ $post->user->name }}</h2>

                <!-- Post Loop -->
                <ul>
                    <!-- Post Item -->
                    <li class="mb-2">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- <img src="https://placekitten.com/40/40" alt="Profile" class="w-8 h-8 rounded-full"> -->
                            </div>
                            <div class="ml-12">
                                <p class="text-gray-700 text-sm">{{ $post->postcontent }}</p>
                                
                                <div class="flex flex-col items-center w-12/12 h-auto rounded">
                                    @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="flex flex-col items-center w-4/12 h-auto rounded">
                                    @endif
                                </div>
                                <div class="ml-4 mt-2">
                                    <div class="panel-footer break-line">
                                        <!-- <a class="hover:text-blue-700 bg-green-400 text-white py-0.5 px-4 rounded hover:no-underline p-2 md:p-2 mb-5" href="{{ route('posts.edit', ['id' => $post->id]) }}" class="text-xs btn btn-link orange-400">Edit</a> -->

                                        <a class="hover:text-blue-700 bg-green-400 text-white py-0.5 px-4 rounded hover:no-underline p-2 md:p-2 mb-5" href="{{ route('posts.edit', ['id' => $post->id]) }}" class="text-xs btn btn-link">Edit</a>
                                        <a class="hover:text-blue-700 bg-green-400 text-white py-0.5 px-4 rounded hover:no-underline p-2 md:p-2 mb-5" href="{{ route('comments.create', ['postid' => $post->id]) }}" class="text-xs btn btn-link">Comment</a>
                                    </div>

                                </div>
                                

                                <div>
                                    <h2 class="justify-left text-lg font-semibold mb-1">Comments</h2> 
                                
                                    <!-- Comment Loop -->
                                    @foreach($post->comments as $comment)
                                    <ul class="ml-4 mt-2">
                                        <!-- Comment Item -->
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <!-- <img src="https://placekitten.com/30/30" alt="Profile" class="w-6 h-6 rounded-full"> -->
                                            </div>
                                            <div class="ml-2">
                                            
                                                <p class="font-bold text-gray-700">{{ $comment->user->name }} said: {{ $comment->commentcontent }} </p>
                                                                                            
                                            </div>
                                        </li>
                                        <!-- End Comment Item -->
                                    </ul>
                                    @endforeach
                                    <!-- End Comment Loop -->
                                </div>
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
