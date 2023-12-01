<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('layouts.app')
    @vite('resources/css/app.css')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
    
@section('content')
<body class="bg-gray-100 font-sans">

    <div class="container relative flex justify-center pt-16">

        <!-- Single Post with Comments -->
        <div class="bg-white rounded-lg p-6 mb-6 w-1/2">
            <!-- Post Content -->
            <div class="mb-4">
                <p class="text-gray-700">Created by {{ $post->user->name }}</p>
                {{ $post->postcontent }}</p>
            </div>

            <!-- Post Image -->
            <div class="mb-4">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-4/12 h-auto rounded">
                @endif
            </div>

            <!-- Comments Section -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Comments</h2>
                <ul>
                    <!-- Single Comment -->
                    @foreach($post->comments as $comment)
                    <li class="flex items-center mb-2">
                        <span class="text-gray-700">{{ $comment->user->name }} said: {{ $comment->commentcontent }}</span>
                    </li>
                    @endforeach
                    <!-- Repeat for more comments -->
                </ul>
            </div>

            <div class="col-start-4 w-full max-w-xs absolute top-0 right-0 p-4 pt-25">

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            {{ Session::get('success') }}
                        </div>
                    @endif


                    <form method="post" action="{{ route('posts.update', ['id' => $post->id]) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
                        
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Edit Post
                            </label>
                            <textarea name="postcontent" cols="30" rows="2" class="shadow appearance-none border rounded w-full text-gray-700 focus:outline-none focus:shadow-outline" type="text" placeholder="Type here to post">
                                {{ $post->postcontent }}
                            </textarea>
                        </div>

                        <div class="flex items-center justify-between pb-5">
                            <input type="file" name="image">
                        </div>

                        <div class="flex items-center justify-center">
                            <input type="submit" value="Update Post" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">     
                        </div>
                    </form>


            </div>
        </div>
        <!-- Repeat the above structure for more posts and comments -->

    </div>  

</body>
@endsection
</html>