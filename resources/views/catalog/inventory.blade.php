@extends('layouts.catalog')

@section('title', 'Inventory')

@section('content')
<div class="space-y-3">

    @foreach ($products as $product)
    <div class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 hover:shadow-md">

        <div class="flex items-start justify-between">

            <div>
                <h2 class="font-semibold text-zinc-900">
                    {{ $product->name }}
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    {{ $product->category->name }}
                </p>
            </div>

            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-600">
                {{ $product->sku }}
            </span>

        </div>

        <div class="mt-4 border-t border-zinc-100 pt-3">
            <p class="text-sm text-zinc-500">
                Available Stock
            </p>

            <p class="text-xl font-bold text-zinc-900">
                {{ $product->stocks->sum('quantity') }}
            </p>
        </div>

    </div>
    @endforeach

</div>
@endsection