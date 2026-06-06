<nav class="fixed bottom-0 left-0 z-20 w-full border-t border-zinc-200 bg-white md:hidden">
    <div class="grid grid-cols-4 text-center text-xs">
        <a href="{{ route('dashboard')  }}"
            class="py-3 {{ request()->routeIs('dashboard') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('dashboard') ? 'bi-house-fill' : 'bi-house' }} text-lg"></i>
        </a>

        <a href="#" class="py-3 text-zinc-500">
            <i class="bi bi-box text-lg"></i>
        </a>

        <a href="#" class="py-3 text-zinc-500">
            <i class="bi bi-clock text-lg"></i>
        </a>

        <a href="#" class="py-3 text-zinc-500">
            <i class="bi bi-person-circle text-lg"></i>
        </a>
    </div>
</nav>