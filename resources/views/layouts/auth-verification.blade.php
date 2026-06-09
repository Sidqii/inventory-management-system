<!DOCTYPE html>
<html lang="en">

<head>
    @include('headline')
</head>

<body>
    <div class="flex min-h-screen items-center justify-center bg-zinc-50 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-8 text-center shadow-sm">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                <i class="bi bi-patch-check-fill text-4xl text-green-600"></i>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-zinc-900">
                Verification Successful
            </h1>

            <p class="mt-4 text-sm leading-6 text-zinc-500">
                Your email has been verified successfully.
                You can now access all features of the Inventory Management System.
            </p>

            <div class="mt-8">
                <a href="/auth"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-zinc-900 px-4 py-3 font-medium text-white transition hover:bg-zinc-800">
                    Continue to Login
                </a>
            </div>

        </div>
    </div>
</body>

</html>