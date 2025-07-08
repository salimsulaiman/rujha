@extends('layout.app')
@section('content')
    <div class="w-full max-w-7xl bg-white px-8 pt-24 pb-16 mx-auto">
        <h1 class="text-2xl text-slate-700 font-medium">{{ $training->title }}</h1>
        <div class="w-full flex gap-12">
            <div class="w-5/7">
                <div class="w-full flex flex-col gap-2 mt-4">
                    @if ($training->is_active === true)
                        <div class="flex gap-2 items-center">
                            <i data-feather="clock"
                                class="size-4 text-emerald-800 group-hover:text-slate-600 transition-colors duration-300 ease-in-out"></i>
                            <h4>{{ $startFormatted }} - {{ $endFormatted }}</h4>
                        </div>
                    @endif
                    <div class="flex gap-2 items-center">
                        <i data-feather="map-pin"
                            class="size-4 text-emerald-800 group-hover:text-slate-600 transition-colors duration-300 ease-in-out"></i>
                        <h4>{{ $training->location }}</h4>
                    </div>
                </div>
                <div class="w-full h-[300px] rounded-xl relative bg-slate-300 mt-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $training->thumbnail) }}" alt=""
                        class="w-full h-full object-cover object-center absolute">
                </div>
                <div class="flex flex-col gap-2 mt-8">
                    <h2 class="text-slate-600 text-sm uppercase font-medium">Deskripsi</h2>
                    <article class="prose max-w-none w-full text-justify mt-6">
                        {!! $training->description !!}
                    </article>
                </div>
            </div>
            <div class="w-2/7">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 ">Order summary</p>
                    <div class="space-y-4">
                        @php
                            $price = $training->price;
                            $tax = $price * 0.1;
                            $total = $price + $tax;
                        @endphp
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Original price</dt>
                                <dd>Rp {{ number_format($price, 0, ',', '.') }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Tax</dt>
                                <dd>Rp {{ number_format($tax, 0, ',', '.') }}</dd>

                            </dl>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                            <dt class="text-base font-bold text-gray-900 ">Total</dt>
                            <dd>Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </dl>
                    </div>

                    <a href="#"
                        class="flex w-full items-center justify-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Proceed
                        to Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
