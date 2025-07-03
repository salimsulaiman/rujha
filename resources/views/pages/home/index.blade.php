@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full">
            <div class="w-full px-8 pt-28 pb-12 bg-gradient-to-b from-white to-slate-200 mx-auto rounded-b-4xl h-[1200px] flex flex-col gap-4 items-center bg-cover bg-center"
                style="background-image: url('/assets/images/hero-bg.jpg');">
                <h1 class="text-5xl text-slate-700 text-center max-w-4xl mx-auto leading-relaxed font-medium">Timeless <span
                        class="text-amber-900 font-bold">Elegance</span>
                    for Little
                    Trendsetters
                    Where
                    <span class="text-amber-900 font-bold">Classic</span> Meets Cute!
                </h1>
                <p class="text-center text-base mx-auto max-w-2xl">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Aspernatur
                    corrupti accusantium molestias sequi ducimus earum possimus voluptates commodi? Hic, beatae!</p>
                <div class="flex gap-4">
                    <button
                        class="rounded-full w-fit bg-white border border-slate-200 cursor-pointer focus:ring-1 focus:ring-slate-300 py-2 px-4 hover:bg-slate-50 mt-2">
                        Explore More
                    </button>
                    <button
                        class="rounded-full w-fit bg-slate-900 text-white cursor-pointer focus:ring-1 focus:ring-slate-900 py-2 px-4 hover:bg-slate-950 mt-2">
                        Order Now
                    </button>
                </div>
            </div>
        </div>
        <section class="w-full max-w-7xl px-8 py-8 mt-12 bg-white mx-auto">
            <div class="flex justify-between gap-4 items-center">
                <h2 class="font-medium text-3xl text-slate-700">Our popular product</h2>
                <div class="flex gap-3">
                    <button
                        class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1">
                        <i data-feather="arrow-left" class="text-slate-700"></i>
                    </button>
                    <button
                        class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1">
                        <i data-feather="arrow-right" class="text-slate-700"></i>
                    </button>
                </div>
            </div>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8">
                @for ($i = 0; $i < 3; $i++)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('assets/images/man.jpg') }}" alt=""
                                class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h5 class="text-base text-slate-500 line-clamp-1">Kemeja</h5>
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">Kemeja Batik</h4>
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1">Rp. 300.000</h3>
                            </div>
                            <button
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </button>
                        </div>
                    </div>
                @endfor
            </div>
        </section>
        <section class="w-full max-w-7xl px-8 py-12 bg-white mx-auto">
            <div class="flex justify-between gap-4 items-center">
                <h2 class="font-medium text-3xl text-slate-700">New arrival product</h2>
            </div>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
                @for ($i = 0; $i < 8; $i++)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('assets/images/man.jpg') }}" alt=""
                                class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h5 class="text-base text-slate-500 line-clamp-1">Kemeja</h5>
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">Kemeja Batik</h4>
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1">Rp. 300.000</h3>
                            </div>
                            <button
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </button>
                        </div>
                    </div>
                @endfor
            </div>

        </section>
        <section class="w-full mt-8">
            <div class="w-full max-w-7xl px-10 py-10 bg-Whisper-50 mx-auto rounded-2xl">
                <div class="flex flex-col gap-4 items-center">
                    <h2 class="font-medium text-3xl text-slate-700 text-center max-w-xl leading-relaxed mx-auto">Find your
                        dream outfit for
                        your
                        child from
                        various categories</h2>
                    <p class="max-w-lg text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste molestias
                        voluptate corporis?</p>
                </div>
                @php
                    $categories = [
                        ['name' => 'Jackets', 'count' => 110, 'image' => 'jackets.jpg'],
                        ['name' => 'Skirts', 'count' => 180, 'image' => 'skirts.jpg'],
                        ['name' => 'Dress', 'count' => 250, 'image' => 'dress.jpg'],
                        ['name' => 'Sweaters', 'count' => 150, 'image' => 'sweaters.jpg'],
                        ['name' => 'Hats', 'count' => 120, 'image' => 'hats.jpg'],
                        ['name' => 'Trousers', 'count' => 210, 'image' => 'trousers.jpg'],
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 w-full mt-12">
                    @foreach ($categories as $index => $category)
                        @php
                            $isWide = in_array($index, [0, 5]); // Jackets & Trousers
                            $isRow = $isWide;
                        @endphp

                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-sm p-3
                                {{ $isWide ? 'md:col-span-2 flex-row items-center rounded-2xl overflow-hidden jusce' : 'flex-col items-center text-center' }}
                                flex gap-4">
                            <div class="{{ $isWide ? 'w-5/7' : 'w-full' }} h-full relative rounded-lg overflow-hidden">
                                <img src="{{ asset('assets/images/man.jpg') }}"
                                    class="object-cover object-center w-full h-full" />
                            </div>
                            <div class="{{ $isRow ? 'text-center w-2/7' : '' }}">
                                <h3 class="text-lg font-semibold text-slate-800">{{ $category['name'] }}</h3>
                                <p class="text-slate-500 text-sm">{{ $category['count'] }}+ Products</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-full flex items-center justify-center mt-8">
                    <button
                        class="rounded-full w-fit bg-white border border-slate-200 cursor-pointer focus:ring-1 focus:ring-slate-300 py-2 px-4 hover:bg-slate-50 mt-2">
                        View More
                    </button>
                </div>


            </div>
        </section>
        <section class="w-full max-w-7xl px-8 py-12 bg-white mx-auto">
            <div class="flex justify-between gap-6 items-end">
                <h2 class="font-medium text-3xl text-slate-700 leading-relaxed w-1/2 max-w-lg">Let's share the
                    profits and
                    achieve
                    success by becoming a seller</h2>
                <p class="w-1/2 max-w-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore reiciendis illo
                    accusamus rem vel quibusdam voluptatum asperiores quos provident totam!</p>
            </div>

        </section>
    </div>
@endsection
