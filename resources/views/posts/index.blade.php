<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite('resources/css/app.css')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    <title>Document</title>
</head>



<body>
        <div class="col-start-4 w-full max-w-xs absolute top-0 right-0 p-4 pt-25">
            <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Post
                    </label>
                    <textarea name="postcontent" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Type here to post"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                    <input type="submit" value="Posts" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">     
                    </div>
            </form>
        </div>
</body>



</html>