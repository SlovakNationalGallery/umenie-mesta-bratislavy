<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-neutral-800">
    <div class="p-8">
        @if (session('import-dispatched'))
            <div class="p-2 bg-green-200 border-green-400 w-40 mb-4">
                {{ session('import-dispatched') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.imports.create') }}">
            @csrf
            @method('PUT')

            <button type="submit"
                class="px-2 rounded-full border-neutral-800 inline-block border hover:bg-neutral-800 hover:text-white">Spustiť
                import</button>
        </form>
    </div>
</body>

</html>
