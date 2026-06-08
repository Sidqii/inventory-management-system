@extends('layouts.catalog')

@section('title', 'Inventory')

@section('content')
<div class="space-y-4">
    @foreach ($products as $product)
    <div class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:hover-zinc-300 hover:shadow-md">
        <!-- (row) product info -->
        <div class="flex items-center justify-between">
            <!-- (column) -->
            <div>
                <h2 class="font-semibold text-zinc-900">{{ $product->name }}</h2>
                <p class="mt-1 text-sm text-zinc-500">{{ $product->category->name }}</p>
            </div>

            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-600">
                {{ $product->sku }}
            </span>
        </div>

        <!-- product quantity -->
        <div class="mt-4 border-t border-zinc-100 pt-3">
            <p class="text-sm text-zinc-500">Total Stock</p>

            <p class="text-1 font-bold text-zinc-900">
                {{ $product->stocks->sum('quantity') }} {{ $product->unit->symbol }}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
@endpush