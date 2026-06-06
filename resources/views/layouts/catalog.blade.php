<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="bg-zinc-100 text-zinc-900">

    <div class="min-h-screen md:flex">
        {{-- Desktop Sidebar --}}
        @include('components.desktop.sidebar')

        {{-- Main Area --}}
        <div class="flex min-h-screen flex-1 flex-col">
            {{-- Top Bar --}}
            @include('components.desktop.topbar')

            {{-- Page Content --}}
            <main class="flex-1 px-4 py-6 pb-24 md:pb-8">
                <div class="mx-auto w-full">
                    @yield('content')
                </div>
            </main>

            {{-- Mobile Bottom Navigation --}}
            @include('components.mobile.bottom-navigation')
        </div>
    </div>

</body>

</html>