@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">
                {{ $category->name }}
            </h1>
        </div>
        <div class="w-full max-w-7xl px-8 mx-auto bg-white pb-8 relative">
            <div class="w-48 h-48 rounded-xl bg-slate-200 relative -top-24 overflow-hidden">
                <img src="{{ asset('storage/' . $category->image) }}" alt=""
                    class="w-full h-full absolute object-cover object-center">
            </div>
            {{-- <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                @forelse($categories as $category)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('storage/' . $category->image) }}" alt=""
                                class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">{{ $category->name }}</h4>
                                <h3 class="text-base text-slate-700 font-normal line-clamp-1">
                                    {{ $category->products->count() }} + Products</h3>
                            </div>
                            <a href="{{ route('products', ['category' => $category->slug]) }}"
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-right" class="text-slate-700"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500">Produk tidak ditemukan.</p>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $categories->appends(request()->query())->links() }}
            </div> --}}
        </div>
    </div>
@endsection
