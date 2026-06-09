<nav class="fixed bottom-0 left-0 z-20 w-full border-t border-zinc-200 bg-white md:hidden">
    <div class="grid grid-cols-4 text-center text-xs">
        <a href="{{ route('dashboard.view') }}"
            class="py-3 {{ request()->routeIs('dashboard.view') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('dashboard.view') ? 'bi-house-fill' : 'bi-house' }} text-lg"></i>
        </a>

        <a href="{{ route('inventory.view') }}"
            class="py-3 {{ request()->routeIs('inventory.view') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('inventory.view') ? 'bi-box-fill' : 'bi-box' }}  text-lg"></i>
        </a>

        <a href="#"
            class="py-3 {{ request()->routeIs('history.view') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('history.view') ? 'bi-clock-fill' : 'bi-clock' }}  text-lg"></i>
        </a>

        <a href="{{ route('credential.view') }}"
            class="py-3 {{ request()->routeIs('credential.view') ? 'text-zinc-900' : 'text-zinc-500'}}">
            <i class="bi {{ request()->routeIs('credential.view') ? 'bi-person-fill' : 'bi-person' }}  text-lg"></i>
        </a>
    </div>
</nav>