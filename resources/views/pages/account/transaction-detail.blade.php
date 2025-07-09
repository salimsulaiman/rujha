@extends('layout.account.app')
@section('content')
    <div class="w-full">
        <div class="w-full max-w-7xl px-2 lg:px-8 py-4 mx-auto flex flex-col gap-4">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('transaction') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Transaction
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">{{ $order->code }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <h1 class="text-2xl font-semibold text-slate-700 mb-4">Transaction Detail</h1>
            <div class="w-full grid grid-cols-3 gap-4 mb-4 gap-y-8">
                <div class="w-full flex flex-col gap-2">
                    <h5 class="uppercase text-slate-500 font-semibold text-xs">Transaction Code</h5>
                    <h4 class="text-slate-700 text-sm font-semibold">{{ $order->code }}</h4>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <h5 class="uppercase text-slate-500 font-semibold text-xs">Customer</h5>
                    <h4 class="text-slate-700 text-sm font-semibold">{{ $order->customer->name }}</h4>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <h5 class="uppercase text-slate-500 font-semibold text-xs">Total Amount + (Tax 10%)</h5>
                    <h4 class="text-slate-700 text-sm font-semibold">Rp.
                        {{ number_format($order->total_amount, 0, ',', '.') }}
                    </h4>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <h5 class="uppercase text-slate-500 font-semibold text-xs">Contact</h5>
                    <div class="flex flex-col gap-1">
                        <h4 class="text-slate-700 text-sm font-semibold">
                            {{ $order->customer->address }}
                        </h4>
                        <h4 class="text-slate-700 text-sm font-semibold">
                            {{ $order->customer->phone }}
                        </h4>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <h5 class="uppercase text-slate-500 font-semibold text-xs">Payment Status</h5>
                    <div>
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    @if ($order->status === 'pending')
                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm w-fit hover:bg-blue-700 cursor-pointer">Pay
                            Now</button>
                    @endif
                </div>
            </div>
            @foreach ($order->items as $index => $item)
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <div class="flex gap-4 items-center">
                            <div class="shrink-0 md:order-1 h-20 w-20 rounded-lg overflow-hidden">
                                <img class="w-full h-full object-cover object-center"
                                    src="{{ asset('storage/' . $item->variant->images->first()->image) }}"
                                    alt="variant image" />
                            </div>
                            <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('product.detail', $item->product->slug) }}"
                                        class="text-lg font-semibold text-gray-900 hover:underline w-fit">
                                        {{ $item->product->name }} <span
                                            class="font-normal">({{ $item->quantity }})</span>
                                    </a>
                                    <div class="flex gap-2">
                                        <div
                                            class="text-xs font-medium text-gray-900 px-4 py-1 rounded-full bg-slate-200 w-fit flex items-center justify-center">
                                            {{ $item->variant->name }}
                                        </div>
                                        <div
                                            class="text-xs font-medium text-gray-900 px-4 py-1 rounded-full bg-slate-200 w-fit flex items-center justify-center">
                                            {{ $item->size?->size_label ?? 'Custom' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                            <div class="text-end md:order-4 md:w-32 flex flex-col gap-1">
                                <p class="text-xs font-normal text-gray-600">
                                    {{ 'Rp ' . number_format($item->variant->price_per_meter, 0, ',', '.') }}
                                    * {{ number_format($item->requested_meter * $item->quantity, 2) }}m
                                </p>
                                <p class="text-base font-bold text-gray-900">
                                    {{ 'Rp ' . number_format($item->variant->price_per_meter * $item->requested_meter * $item->quantity, 0, ',', '.') }}
                                </p>
                                <div>
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">{{ $item->progress->status }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
