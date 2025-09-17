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

    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <h1>Halo selamat datang di Panel Admin</h1>
            <h1> {{ Auth::user()->name }} </h1>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-5" type="submit">Logout</button>
            </form>
        </div>

    </div>


</body>

</html>
