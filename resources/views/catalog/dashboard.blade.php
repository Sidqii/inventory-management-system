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
            <div>
                <h2 class="font-semibold text-zinc-900">Latest Requests</h2>
                <p class="text-xs text-zinc-500">Recent stock request activities</p>
            </div>

            <a href="#" class="text-sm font-medium text-zinc-500">
                View all
            </a>
        </div>

        <div class="space-y-3">
            @foreach ($latestRequests as $latest)
            <div class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm">
                <div class="mb-3 flex items-start justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <p class="font-semibold text-zinc-900">
                                {{ $latest->user->name }}
                            </p>

                            <span class="text-xs text-zinc-400">
                                {{ $latest->request_number }}
                            </span>
                        </div>

                        @if($latest->note)
                        <p class="mt-3 rounded-lg bg-zinc-50 p-3 text-sm text-zinc-600">
                            {{ $latest->note }}
                        </p>
                        @endif
                    </div>

                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">
                        {{ $latest->status }}
                    </span>
                </div>
                <button
                    type="button"
                    class="detail-toggle text-sm font-medium text-zinc-500 hover:text-zinc-900">
                    Detail Item
                </button>

                <div class="detail-content mt-3 hidden space-y-2">
                    @foreach ($latest->items as $item)
                    <div class="flex items-center justify-between rounded-xl bg-zinc-50 px-3 py-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-900">
                                {{ $item->product->name ?? '-' }}
                            </p>

                            <p class="text-xs text-zinc-500">
                                Requested item
                            </p>
                        </div>

                        <p class="text-sm font-semibold text-zinc-900">
                            x{{ $item->quantity_requested }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.detail-toggle').forEach(function(detailButton) {
        detailButton.addEventListener('click', function() {
            const detailContent = detailButton.nextElementSibling;

            detailContent.classList.toggle('hidden');
        });
    });
</script>
@endpush