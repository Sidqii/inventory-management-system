<!DOCTYPE html>
<html lang="en">

<head>
    @include('headline')
</head>

<body class="select-none bg-slate-50 text-zinc-900">
    <div class="min-h-screen md:flex">
        <!-- sidebar device desktop -->
        @include('components.side-bar')

        <div class="flex min-h-screen flex-1 flex-col">
            <!-- top bar -->
            @include('components.top-bar')

            <!-- main content -->
            <main class="flex-1 px-4 py-6 pb-24 md:pb-8">
                <div class="mx-auto w-full">
                    @yield('content')
                </div>
            </main>

            <!-- navbar device mobile -->
            @include('components.bottom-navbar')
        </div>
    </div>
    <!-- scripts -->
    @stack('scripts')
</body>

</html>