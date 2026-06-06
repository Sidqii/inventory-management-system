<nav class="fixed bottom-0 left-0 z-20 w-full border-t border-zinc-200 bg-white md:hidden">
    <div class="grid grid-cols-4 text-center text-xs">
        <a href="{{ route('dashboard.index')  }}"
            class="py-3 {{ request()->routeIs('dashboard.index') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('dashboard.index') ? 'bi-house-fill' : 'bi-house' }} text-lg"></i>
        </a>

        <a href="{{ route('inventory.index') }}"
            class="py-3 {{ request()->routeIs('inventory.index') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('inventory.index') ? 'bi-box-fill' : 'bi-box' }}  text-lg"></i>
        </a>

        <a href="{{ route('history.index') }}"
            class="py-3 {{ request()->routeIs('history.index') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('history.index') ? 'bi-clock-fill' : 'bi-clock' }}  text-lg"></i>
        </a>

        <a href="{{ route('credential.index') }}"
            class="py-3 {{ request()->routeIs('credential.index') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('credential.index') ? 'bi-person-fill' : 'bi-person' }}  text-lg"></i>
        </a>
    </div>
</nav>