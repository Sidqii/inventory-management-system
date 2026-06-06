@extends('layouts.auth')

@section('title', 'Authentication')

@section('content')
<div class="w-full max-w-md rounded-xl bg-white p-8">

    <h1 class="mb-2 text-2xl font-bold">
        Inventory Management System
    </h1>

    @error('auth')
    <p class="mb-4 text-sm text-red-500">
        {{ $message }}
    </p>
    @else
    <p class="mb-4 text-sm text-zinc-500">
        Sign in to continue
    </p>
    @enderror

    <form id="login-form" action="{{ route('login') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="mb-2 block text-xs font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full rounded-lg border px-3 py-2
                @error('email') border-red-500
                @else border-zinc-300
                @enderror">
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-medium">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full rounded-lg border px-3 py-2
                @error('password') border-red-500
                @else border-zinc-300
                @enderror">
        </div>

        <button id="login-button" type="submit" class="w-full rounded-lg bg-zinc-900 py-3 text-white">
            Login
        </button>

    </form>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById("login-form").addEventListener("submit", function() {
        const button = document.getElementById("login-button");

        button.disabled = true;
        button.textContent = "Logging in ..."
    });
</script>
@endpush