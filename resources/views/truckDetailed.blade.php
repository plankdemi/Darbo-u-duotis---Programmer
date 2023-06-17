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

    <h1 class="p-4 m-4 text-6xl text-slate-700 text-center">Truck: {{ request()->route('unitNumber') }}</h1>
    <div class="w-full flex justify-around">
        <ul class="w-3/4 text-center block">
            @foreach ($truckSubs as $trucksub)
                <li>
                    {{ $trucksub->subunit }} is subbing for
                    {{ $trucksub->main_truck }}
                    from {{ $trucksub->start_date }}
                    to {{ $trucksub->end_date }}
                </li>
            @endforeach
        </ul>

    </div>



    <h1 class="pt-4 mt-4 text-6xl text-slate-700 text-center">New sub for truck {{ request()->route('unitNumber') }}
    </h1>


    <div class="flex justify-center px-4 mx-4 w-full text-center ">

        <form method="POST" action="{{ route('createSub') }}"
            class="w-1/2 mx-auto block bg-slate-700 p-10 m-10 rounded-xl">
            @csrf
            @method('POST')

            @if ($errors->has('Fail'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"
                    role="alert">
                    <span class="block sm:inline">{{ $errors->first('Fail') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">

                    </span>
                </div>
            @endif

            <div class="mb-4">
                <label for="main_truck" class="block text-slate-100 py-4">Truck</label>
                <input type="text" name="main_truck" id="main_truck" value="{{ request()->route('unitNumber') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm bg-gray-200 cursor-not-allowed" readonly>
            </div>

            <div class="mb-4">
                <label for="subunit" class="block text-slate-100 py-4">Subbing Truck</label>
                <input type="text" name="subunit" id="subunit" value="{{ $model->subunit ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-slate-100 py-4">From</label>
                <input type="date" name="start_date" id="start_date" value="{{ $model->start_date ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-slate-100 py-4">To</label>
                <input type="date" name="end_date" id="end_date" value="{{ $model->end_date ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>



            <button type="submit" class="bg-slate-100 py-4 px-8 my-4 mx-8 rounded-xl text-slate-700">Modify</button>
        </form>
    </div>



</body>

</html>
