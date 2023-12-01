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
<body>

    <div class="container relative justify-center pt-16">
        <div class="flex flex-col items-center min-h-screen ">
                    @foreach(Auth::user()->posts as $post)
                        <div class="flex flex-col bg-white rounded-lg items-center overflow-hidden shadow-md w-full max-w-md mb-4">
                            <div class="mb-4">
                                <p class="text-gray-700">Created by {{ $post->user->name }}</p>
                                {{ $post->postcontent }}</p>
                            </div>

                            <!-- Post Image -->
                            <div class="flex flex-col items-center mb-4">
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="flex flex-col items-center w-4/12 h-auto rounded">
                                @endif
                            </div>

                            <div class="panel-footer break-line">
                                    <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="text-xs btn btn-link orange-400">Edit</a>
                                    <a href="" class="text-xs btn btn-link">Comment</a>
                            </div>
                        </div>
                    @endforeach


                    <div class="col-start-4 w-full max-w-xs absolute top-0 right-0 p-4 pt-25">
                        
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="max-w-screen-xl bg-purple mx-auto p-4 list-disc pl-4 text-red-500">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                        <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">

                                @csrf
                                <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Post
                                </label>
                                <textarea name="postcontent" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Type here to post"></textarea>
                                </div>

                                <div class="flex items-center justify-between">
                                    <input type="file" name="image">
                                </div>

                                <div class="flex items-center justify-between">
                                <input type="submit" value="Posts" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">     
                                </div>
                        </form>
                    </div>
        </div>

    </div>
</body>
@endsection


</html>