@extends('layouts.catalog')

@section('title', 'Movements')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl bg-white p-4">
        <h1 class="font-bold text-xl">Inventory Movements</h1>
        <p class="text-sm text-zinc-500">Latest Movement Items</p>
    </div>

    <div class="rounded-2xl bg-white p-4">
        @forelse($movements as $movement)
        <div>
            <p>{{ $movement->request_number }}</p>
            <p>{{ $movement->status }}</p>
            <p>{{ $movement?->note ?? 'No submission records' }}</p>
        </div>
        @empty

        <div class="max-h-md">
            <p>
                Empty recap for movement items.
            </p>
        </div>

        @endforelse
    </div>
</div>
@endsection