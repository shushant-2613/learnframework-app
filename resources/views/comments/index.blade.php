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
<body class="bg-gray-100">

    <div class="container relative justify-center pt-16">
        <div class="flex flex-col items-center min-h-screen ">
                    
                        <div class="border border-gray-300 flex flex-col bg-gray-100 rounded-lg items-center overflow-hidden shadow-md w-full max-w-md mb-4">
                            <div class="mb-4">
                                <p class="font-semibold text-gray-700">Created by {{ $post->user->name }}</p>
                                <p>{{ $post->postcontent }}</p>
                            </div>

                            <!-- Post Image -->
                            <div class="flex flex-col items-center mb-4">
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="flex flex-col items-center w-12/12 h-auto rounded">
                                @endif
                            </div>

                            <!-- Comments Section -->
                            <div id="commentsList">
                                <h2 class="justify-left text-lg font-semibold mb-1">Comments</h2>
                                <ul>
                                    <!-- Single Comment -->
                                    @foreach($comments as $comment)
                                    <li class="flex items-center mb-2" id="commentsList">
                                        <span class="font-bold text-gray-700">{{ $comment->user->name }} said: {{ $comment->commentcontent }}</span>
                                    </li>
                                    @endforeach
                                    <!-- Repeat for more comments -->
                                </ul>
                            </div>
                        </div>
                 


                    <div class="col-start-4 w-full max-w-xs absolute top-0 right-0 p-4 pt-25">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            {{ Session::get('success') }}
                        </div>
                    @endif


                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multiple/form-data">

                    @csrf
                    <input type="hidden" class="post_id" value="{{ $post->id }}">
                    <input type="hidden" class="user_id" value="{{ auth()->user()->id }}">
                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Add a comment
                      </label>
                      <textarea name="commentcontent" class="commentcontent shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Type here to add a comment"></textarea>
                    </div>


                    <div class="flex items-center justify-between">
                        <button class="add_comment bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>     
                    </div>
                </form>
                    </div>
        </div>
        
    </div>
</body>
@endsection

@section('scripts')

    <script>

        $(document).ready(function () {

            $(document).on('click', '.add_comment', function (e) {
                e.preventDefault();
                // console.log('hello man');

                var data = {
                    'commentcontent' : $('.commentcontent').val(),
                    'post_id': $('.post_id').val(),
                    'user_id': $('.user_id').val(),
                }

                // console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/comments",
                    data: data,
                    dataType: "json",
                    success: function(response){
                        $('#commentsList').append('<li class="flex items-center mb-2">' +
                        '<span class="font-bold text-gray-700">' +
                        response.user.name + ' said: ' +
                        response.commentcontent +
                        '</span>' +
                        '</li>');

                        // Clear the textarea after successful submission
                         $('textarea[name=commentcontent]').val('');
                    }
                });
            });

        });

    </script>

@endsection

</html>