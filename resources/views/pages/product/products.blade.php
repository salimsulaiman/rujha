@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">All Product</h1>
        </div>
        <div class="w-full max-w-7xl px-8 mx-auto bg-white pt-16 pb-8">
            <h2 class="font-medium text-2xl sm:text-3xl text-slate-700">
                Popular product
            </h2>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                @foreach ($popularProducts as $product)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->variants->first()->images->first()->image) }}"
                                alt="" class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h5 class="text-base text-slate-500 line-clamp-1">{{ $product->category->name }}</h5>
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">{{ $product->name }}</h4>
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1"> Rp
                                    {{ number_format($product->variants->first()->price_per_meter, 0, ',', '.') }}/m</h3>
                            </div>
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-full max-w-7xl px-8 mx-auto bg-white py-8">
            <h2 class="font-medium text-2xl sm:text-3xl text-slate-700">
                All product
            </h2>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                @foreach ($products as $product)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->variants->first()->images->first()->image) }}"
                                alt="" class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h5 class="text-base text-slate-500 line-clamp-1">{{ $product->category->name }}</h5>
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">{{ $product->name }}</h4>
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1"> Rp
                                    {{ number_format($product->variants->first()->price_per_meter, 0, ',', '.') }}/m</h3>
                            </div>
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
