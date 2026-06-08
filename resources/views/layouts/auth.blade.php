<!DOCTYPE html>
<html lang="en">

<head>
    @include('headline')
</head>

<body>
    <div class="flex min-h-screen items-center bg-slate-50 justify-center px-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>