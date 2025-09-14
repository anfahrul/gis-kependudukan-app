<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Kependudukan | {{ $title }} </title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <x-navbar></x-navbar>

    <x-header>
        <x-slot:title>{{ $title }}</x-slot:title>
        <x-slot:titleDescription>{{ $titleDescription }}</x-slot:titleDescription>
    </x-header>

    <!-- main -->
    <main>

        <div>
            {{ $slot }}
        </div>
        {{-- <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div> --}}

    </main>

    <x-footer></x-footer>
</body>

</html>
