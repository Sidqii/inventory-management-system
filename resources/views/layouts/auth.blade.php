<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="bg-zinc-100">
    <div class="flex min-h-screen items-center justify-center bg-white px-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>