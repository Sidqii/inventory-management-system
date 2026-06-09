<aside class="hidden w-64 border-r border-zinc-200 bg-white md:block">
    <div class="p-6">
        <h1 class="text-xl font-bold">Inventory</h1>
        <p class="text-sm text-zinc-500">Management System</p>
    </div>

    <nav class="space-y-1 px-4">
        <a href="{{ route('dashboard.view') }}"
            class="block rounded-xl {{ request()->routeIs('dashboard.view') ? 'bg-zinc-900 text-white px-4 py-3' : 'text-zinc-600 hover:bg-zinc-100'}} px-4 py-1 text-sm">
            Dashboard
        </a>

        <a href="{{ route('inventory.view') }}"
            class="block rounded-xl {{ request()->routeIs('inventory.view') ? 'bg-zinc-900 text-white px-4 py-3' : 'text-zinc-600 hover:bg-zinc-100'}} px-4 py-1 text-sm">
            Products
        </a>

        <a href="{{ route('movement.view') }}"
            class="block rounded-xl {{ request()->routeIs('movement.view') ? 'bg-zinc-900 text-white px-4 py-3' : 'text-zinc-600 hover:bg-zinc-100'}} px-4 py-1 text-sm">
            History
        </a>

        <a href="{{ route('credential.view') }}"
            class="block rounded-xl {{ request()->routeIs('credential.view') ? 'bg-zinc-900 text-white px-4 py-3' : 'text-zinc-600 hover:bg-zinc-100'}} px-4 py-1 text-sm">
            Profile
        </a>
    </nav>
</aside>