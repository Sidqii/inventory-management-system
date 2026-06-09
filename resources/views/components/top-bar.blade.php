<header class="sticky top-0 z-10 border-b border-zinc-200 bg-white px-4 py-4 md:px-8">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-zinc-500">Welcome back</p>
            <h1 class="text-lg font-bold">{{ auth()->user()->name }}</h1>
        </div>

        <button class="rounded-full px-1 py-2 text-l md:hidden">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
</header>