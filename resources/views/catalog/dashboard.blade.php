@extends('layouts.catalog')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Summary Cards --}}
    <section class="grid grid-cols-2 gap-3">
        @include('components.dashboard.summary-card', [
        'title' => 'Products',
        'value' => $products
        ])

        @include('components.dashboard.summary-card', [
        'title' => 'Total Items',
        'value' => $stock
        ])

        @include('components.dashboard.summary-card', [
        'title' => 'Requests',
        'value' => $totalRequests
        ])

        @include('components.dashboard.summary-card', [
        'title' => 'Movements',
        'value' => $totalMovements
        ])
    </section>

    {{-- Quick Actions --}}
    <section class="rounded-2xl bg-white p-4 shadow-sm">
        <h2 class="mb-4 font-semibold">Quick Actions</h2>

        <div class="grid grid-cols-2 gap-3">
            <a href="#" class="rounded-xl bg-zinc-900 px-4 py-3 text-center text-sm text-white">
                Add Product
            </a>

            <a href="#" class="rounded-xl border border-zinc-200 px-4 py-3 text-center text-sm">
                New Request
            </a>
        </div>
    </section>

    {{-- Latest Requests --}}
    <section class="rounded-2xl bg-white p-4 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-semibold">Latest Requests</h2>
            <a href="#" class="text-sm text-zinc-500">View all</a>
        </div>

        <div class="space-y-3">
            <div class="rounded-xl border border-zinc-200 p-3">
                <p class="font-medium">Request #001</p>
                <p class="text-sm text-zinc-500">Warehouse A • Pending</p>
            </div>

            <div class="rounded-xl border border-zinc-200 p-3">
                <p class="font-medium">Request #002</p>
                <p class="text-sm text-zinc-500">Warehouse B • Approved</p>
            </div>
        </div>
    </section>

</div>
@endsection