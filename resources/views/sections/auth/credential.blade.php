@extends('layouts.catalog')

@section('title', 'Credential')

@section('content')
<div class="space-y-3">
    <!-- header credential -->
    <div class="flex items-center gap-4 mb-6">
        <div class="flex h-15 w-15 items-center justify-center rounded-full bg-zinc-900 text-xl fint-bold text-white">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>

            <div class="flex items-center gap-2">
                <p
                    id="user-email"
                    class="text-sm text-zinc-500">{{ $user->email }}</p>

                <button
                    id="copy-email"
                    type="button"
                    class="cursor-pointer text-zinc-400 transition hover:text-zinc-700">
                    <i class="bi bi-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- full name -->
    @include('components.box-credentials',[
    'title' => 'Full Name',
    'value' => $user->name
    ])

    <!-- email address -->
    @include('components.box-credentials', [
    'title' => 'Email Address',
    'value' => $user->email
    ])

    <!-- role and joined at -->
    <div class="grid gap-3 md:grid-cols-2">
        @include('components.box-credentials', [
        'title' => 'Role',
        'value' => $user->role
        ])

        @include('components.box-credentials', [
        'title' => 'Joined at',
        'value' => $user->created_at->format('d F Y')
        ])
    </div>

    <!-- email Verification -->
    <div class="flex items-center justify-between rounded-xl border border-zinc-200 p-4 bg-white hover:hover-zinc-300 hover:shadow-md">
        <p class="text-sm text-zinc-500">Email Verification</p>

        @if ($user->hasVerifiedEmail())
        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 txt-sm font-medium text-green-700">
            <i class="bi bi-patch-check-fill mr-2"> Verified</i>
        </span>

        @else
        <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 txt-sm font-medium text-red-700">
            <i class="bi bi-exclamation-circle-fill mr-2"> Not Verified</i>
        </span>
        @endif
    </div>

    <!-- logout action button -->
    <form
        id="logout-form"
        action="{{ route('logout') }}"
        method="POST"
        class="flex justify-end">

        @csrf

        <button
            type="submit"
            class="cursor-pointer md:fixed bottom-5 rounded-lg bg-red-500 px-4 py-2 text-sm font-regular text-white hover:bg-red-600">
            Logout Account
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('logout-form')?.addEventListener('submit', function(event) {
        const confirmed = confirm('Are you sure want to log out?');

        if (!confirmed) {
            event.preventDefault();
        }
    });

    document.getElementById('copy-email').addEventListener('click', async function() {
        const email = document.getElementById('user-email').innerText.trim();

        await navigator.clipboard.writeText(email);

        this.innerHTML = '<i class="bi bi-check-lg text-green-600"></i>';

        setTimeout(() => {
            this.innerHTML = '<i class="bi bi-copy"></i>'
        }, 1500);
    });
</script>
@endpush