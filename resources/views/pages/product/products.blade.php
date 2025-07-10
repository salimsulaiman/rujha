@extends('layout.app')
@section('content')
    <div class="w-full" x-data="{ sort: '{{ request('sort', 'Terbaru') }}' }">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">
                Product
            </h1>
        </div>
        <div class="w-full max-w-7xl px-8 mx-auto bg-white py-8">
            <h2 class="font-medium text-2xl sm:text-3xl text-slate-700">
                @if ($search)
                    {{ $search }}
                @else
                    All Products
                @endif
            </h2>
            <div class="w-full overflow-x-auto py-2 md:py-0 mt-4">
                <div class="flex gap-3 min-w-max px-1 py-2">
                    <!-- Tombol "Terbaru" -->
                    @php
                        $sort = request('sort');
                        $sortLabel = match ($sort) {
                            'popular' => 'Populer',
                            default => 'Terbaru',
                        };
                    @endphp
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="shrink-0 px-4 py-2 rounded-full bg-gray-50 text-slate-700 font-medium whitespace-nowrap flex items-center"
                        type="button">
                        {{ $sortLabel }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-xl shadow-sm w-44">
                        <ul class="py-2 px-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('products', array_merge(request()->query(), ['sort' => 'newest'])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 rounded-lg font-medium">
                                    Terbaru
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products', array_merge(request()->query(), ['sort' => 'popular'])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 rounded-lg font-medium">
                                    Populer
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Filter Kategori -->
                    <a href="{{ route('products', ['search' => request('search')]) }}"
                        class="shrink-0 px-4 py-2 rounded-full {{ request()->has('category') ? 'bg-white hover:bg-slate-200 text-slate-700' : 'bg-slate-800 text-white' }} whitespace-nowrap">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('products', ['search' => request('search'), 'category' => $category->slug]) }}"
                            class="shrink-0 px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-slate-800 text-white' : 'bg-white hover:bg-slate-200 text-slate-700' }} whitespace-nowrap">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                @forelse($products as $product)
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
                @empty
                    <p class="col-span-full text-gray-500">Produk tidak ditemukan.</p>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
