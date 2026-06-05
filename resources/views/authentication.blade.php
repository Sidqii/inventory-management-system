<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Login</title>
</head>

<body class="bg-zinc-100">

    <div class="flex min-h-screen items-center justify-center">

        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow">

            <h1 class="mb-2 text-2xl font-bold">
                Inventory Management System
            </h1>

            <p class="mb-6 text-sm text-zinc-500">
                Sign in to continue
            </p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2">
                </div>

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-lg border border-zinc-300 px-3 py-2">
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-zinc-900 py-2 text-white">
                    Login
                </button>

            </form>

        </div>

    </div>

</body>

</html>