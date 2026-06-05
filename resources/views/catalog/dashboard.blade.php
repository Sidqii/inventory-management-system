<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>Inventatis Management System</title>
</head>

<body>
    <div class="flex justify-between bg-zinc-900 p-4">
        <h1 class="text-x1 text-white">Inventory Management System</h1>

        <button>
            <i class="bi bi-list text-white"></i>
        </button>
    </div>

    <main class="min-h-screen p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-zinc-900">Dashboard</h2>
            <p class="text-sm text-zinc-400">Overview inventory activity.</p>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div class="rounded-xl bg-zinc-900 p-5 border border-zinc-800">
                <p class="text-sm text-zinc-400">Products</p>
                <h3 class="mt-2 text-3xl font-bold text-white">124</h3>
            </div>

            <div class="rounded-xl bg-zinc-900 p-5 border border-zinc-800">
                <p class="text-sm text-zinc-400">Warehouses</p>
                <h3 class="mt-2 text-3xl font-bold text-white">4</h3>
            </div>

            <div class="rounded-xl bg-zinc-900 p-5 border border-zinc-800">
                <p class="text-sm text-zinc-400">Stock Requests</p>
                <h3 class="mt-2 text-3xl font-bold text-white">18</h3>
            </div>

            <div class="rounded-xl bg-zinc-900 p-5 border border-zinc-800">
                <p class="text-sm text-zinc-400">Movements</p>
                <h3 class="mt-2 text-3xl font-bold text-white">52</h3>
            </div>
        </div>
    </main>
</body>

</html>