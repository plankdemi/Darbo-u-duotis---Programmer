<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

    <link rel="stylesheet" href="{{ mix('/resources/css/app.css') }}">
</head>

<body class="antialiased">


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1 class="p-4 m-4 text-6xl text-slate-700 text-center">Trucks</h1>
    <div class="w-full flex justify-around">
        <ul class="w-3/4 text-center">
            @foreach ($trucks as $truck)
                <a href="/truck/{{ $truck->unitNumber }}">
                    <button class="inline-block py-4 my-4 px-8 mx-8 bg-slate-700 rounded-full text-slate-200 underline">
                        <li>{{ $truck->unitNumber }}<br> {{ $truck->year }} <br>{{ $truck->notes }}</li>
                    </button>

                </a>
            @endforeach
        </ul>
    </div>





    <h1 class="pt-4 mt-4 text-6xl text-slate-700 text-center">Add/Update</h1>
    <div class="flex justify-center px-4 mx-4 w-full text-center ">

        <form method="POST" action="{{ route('cr&u') }}" class="w-1/2 mx-auto block bg-slate-700 p-10 m-10 rounded-xl">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="unitNumber" class="block text-slate-100 py-4">Unit Number</label>
                <input type="text" name="unitNumber" id="unitNumber" value="{{ $model->unitNumber ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="year" class="block text-slate-100 py-4">Year</label>
                <input type="number" name="year" id="year" value="{{ $model->year ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-slate-100 py-4">Notes</label>
                <input type="text" name="notes" id="notes" value="{{ $model->notes ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-slate-100 py-4 px-8 my-4 mx-8 rounded-xl text-slate-700">Modify</button>
        </form>
    </div>



    <h1 class="pt-4 mt-4 text-6xl text-slate-700 text-center">Delete</h1>
    <div class="flex justify-center px-4 mx-4 w-full text-center ">

        <form method="POST" action="{{ route('delete') }}"
            class="w-1/2 mx-auto block bg-slate-700 p-10 m-10 rounded-xl">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="unitNumber" class="block text-slate-100 py-4">Unit Number</label>
                <input type="text" name="unitNumber" id="unitNumber" value="{{ $model->unitNumber ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-slate-100 py-4 px-8 my-4 mx-8 rounded-xl text-slate-700">Remove</button>
        </form>
    </div>






</body>

</html>
