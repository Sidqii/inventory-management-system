@extends('layouts.catalog')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- summary cards -->
    <section class="grid grid-cols-2 gap-4">
        @include('components.summary-card', [
        'title' => 'Products',
        'value' => $products
        ])
        @include('components.summary-card', [
        'title' => 'Total Items',
        'value' => $stock
        ])
        @include('components.summary-card', [
        'title' => 'Requests In',
        'value' => $totalRequests
        ])
        @include('components.summary-card', [
        'title' => 'Movements Items',
        'value' => $totalMovements
        ])
    </section>

    <!-- quick action -->
    <section class="rounded-2xl bg-white p-4 shadow-sm">
        <h2 class="mb-4 font-semibold">Quick Actions</h2>

        <div class="grid grid-cols-2 gap-3">
            @include('components.box-quick-action', [
            'route' => '#',
            'title' => 'Add Product'
            ])

            @include('components.box-quick-action', [
            'route' => '#',
            'title' => 'Do Approval'
            ])
        </div>
    </section>

    <!-- (outer body) latest requests -->
    <section class="rounded-2xl bg-white p-4 shadow-sm">
        <!-- (row) -->
        <div class="mb-4 flex items-center justify-between">
            <!-- (column) -->
            <div>
                <h2 class="font-semibold text-zinc-900">Latest Requests</h2>
                <p class="text-xs text-zinc-500">Recent stock request activities</p>
            </div>

            <a href="#" class="text-sm font-medium text-zinc-500">See More</a>
        </div>

        <!-- listview -->
        <div class="space-y-3">
            @forelse ($latestRequests as $latest)
            <div class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm">
                <!-- (row) card info header -->
                <div class="mb-3 flex items-start justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-semibold text-zinc-900">{{ $latest->user->name }}</p>

                        <span class="text-xs text-zinc-400">{{ $latest->request_number }}</span>
                    </div>

                    <span class="shrink-0 rounded-full bg-yellow-100 px-2 py-1 text-xs text-yellow-700 font-medium">
                        <p>{{ $latest->status }}</p>
                    </span>
                </div>

                <!-- note? -->
                @if($latest->note)
                <p class="mb-3 w-full rounded-lg bg-zinc-50 p-3 text-sm text-zinc-600">
                    {{ $latest->note }}
                </p>
                @endif

                <!-- detail item button -->
                <button
                    type="button"
                    class="cursor-pointer detail-toggle text-sm font-medium text-zinc-500 hover:text-zinc-900">
                    Detail Item
                </button>

                <!-- main content -->
                <div class="detail-content mt-3 hidden space-y-2">
                    @foreach ($latest->items as $item)
                    <div class="flex items-center justify-between rounded-xl bg-zinc-50 px-3 py-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-900">{{ $item->product->name ?? "-" }}</p>

                            <p class="text-xs text-zinc-500">Requested item</p>
                        </div>

                        <p class="text-sm font-semibold text-zinc-900">x{{ $item->quantity_requested }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            @empty

            <div class="flex items-center justify-center rounded-xl bg-zinc-50 px-4 py-14 hover:shadow-sm">
                <p class="text-zinc-500 font-semibold">Its'empty here, just relax ~</p>
            </div>
            @endforelse
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