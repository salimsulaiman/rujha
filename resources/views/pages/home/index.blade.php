@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full">
            <div class="w-full relative px-4 sm:px-8 pt-20 sm:pt-28 pb-12 bg-gradient-to-b from-white to-slate-200 mx-auto rounded-b-4xl h-[600px] sm:h-[1200px] flex flex-col gap-4 items-center justify-center sm:justify-start bg-cover bg-center text-center"
                style="background-image: url('/assets/images/hero-bg.jpg');">
                <div class="absolute inset-0 bg-black/30 sm:bg-transparent z-0 rounded-b-4xl"></div>
                <div class="relative z-10 flex flex-col gap-4 items-center">
                    <h1
                        class="text-2xl sm:text-5xl text-white sm:text-slate-700 text-center max-w-4xl mx-auto leading-relaxed font-medium">
                        Timeless <span class="text-amber-400 sm:text-amber-900 font-bold">Elegance</span>
                        for Little Trendsetters Where
                        <span class="text-amber-400 sm:text-amber-900 font-bold">Classic</span> Meets Cute!
                    </h1>
                    <p class="text-sm sm:text-base text-white sm:text-slate-600 text-center max-w-2xl mx-auto">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur corrupti accusantium molestias
                        sequi ducimus earum possimus voluptates commodi? Hic, beatae!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
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
        </div>

        <section class="w-full max-w-7xl px-8 py-8 mt-12 bg-white mx-auto">
            <div class="flex flex-col sm:flex-row sm:justify-between gap-4 sm:items-center">
                <h2 class="font-medium text-2xl sm:text-3xl text-slate-700">
                    Our popular product
                </h2>
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
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1">
                                    Rp {{ number_format($product->variants->first()->price_per_meter, 0, ',', '.') }}/m
                                </h3>
                            </div>
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="w-full max-w-7xl px-8 py-12 bg-white mx-auto">
            <div class="flex justify-between gap-4 items-center">
                <h2 class="font-medium text-3xl text-slate-700">New arrival product</h2>
            </div>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
                @foreach ($newProducts as $product)
                    <div class="p-2 bg-white border border-gray-200 rounded-3xl">
                        <div class="relative aspect-[3/4] rounded-2xl bg-slate-100 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->variants->first()->images->first()->image) }}"
                                alt="" class="absolute w-full h-full object-center object-cover">
                        </div>
                        <div class="flex items-end justify-between gap-2 px-4 my-3">
                            <div class="flex flex-col gap-1">
                                <h5 class="text-base text-slate-500 line-clamp-1">{{ $product->category->name }}</h5>
                                <h4 class="text-xl text-slate-700 font-medium line-clamp-1">{{ $product->name }}</h4>
                                <h3 class="text-2xl text-slate-700 font-bold line-clamp-1">
                                    Rp {{ number_format($product->variants->first()->price_per_meter, 0, ',', '.') }}/m
                                </h3>
                            </div>
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="rounded-full h-10 w-10 bg-white hover:bg-slate-100 border border-slate-200 flex items-center justify-center cursor-pointer focus:ring-1 focus:ring-slate-300 p-1 shrink-0">
                                <i data-feather="arrow-up-right" class="text-slate-700"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
        <section class="w-full mt-8">
            <div class="w-full max-w-7xl px-10 py-10 bg-Whisper-50 mx-auto rounded-2xl">
                <div class="flex flex-col gap-4 items-center">
                    <h2
                        class="font-medium text-2xl md:text-3xl text-slate-700 text-center max-w-xl leading-relaxed mx-auto">
                        Find your
                        dream outfit for
                        your
                        child from
                        various categories</h2>
                    <p class="max-w-lg text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste molestias
                        voluptate corporis?</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 w-full mt-12">
                    @foreach ($categories as $index => $category)
                        @php
                            $isWide = in_array($index, [0, 5]); // Jackets & Trousers
                            $isRow = $isWide;
                        @endphp

                        <a href="{{ route('products', ['category' => $category->slug]) }}"
                            class="bg-white rounded-xl overflow-hidden shadow-sm p-3 block
                                {{ $isWide ? 'md:col-span-2 flex-row items-center rounded-2xl overflow-hidden jusce' : 'flex-col items-center text-center' }}
                                flex gap-4">
                            <div class="{{ $isWide ? 'w-5/7' : 'w-full' }} h-full relative rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $category->image) }}"
                                    class="object-cover object-center w-full h-full" />
                            </div>
                            <div class="{{ $isRow ? 'text-center w-2/7' : '' }}">
                                <h3 class="text-lg font-semibold text-slate-800">{{ $category->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $category->products->count() }}+ Products</p>
                            </div>
                        </a>
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
            <div class="flex flex-col lg:flex-row justify-between gap-6 items-start lg:items-center">
                <h2 class="font-medium text-2xl sm:text-3xl text-slate-700 leading-relaxed w-full lg:w-1/2 max-w-lg">
                    Let's share the profits and achieve success by becoming a seller
                </h2>
                <p class="w-full lg:w-1/2 max-w-md text-slate-600 text-base">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore reiciendis illo accusamus rem vel
                    quibusdam.
                </p>
            </div>
            <div class="w-full flex flex-col lg:flex-row gap-4 justify-between mt-8">
                <div
                    class="w-full lg:w-7/12 h-[300px] sm:h-[400px] lg:h-[600px] rounded-xl bg-slate-100 relative overflow-hidden">
                    <img src="{{ asset('assets/images/shirt.jpg') }}" alt=""
                        class="h-full w-full object-cover object-center absolute">
                </div>
                <div
                    class="w-full lg:w-5/12 h-[300px] sm:h-[400px] lg:h-[600px] rounded-xl bg-thunder-950 relative overflow-hidden">
                    <img src="{{ asset('assets/images/line.png') }}" alt=""
                        class="h-full w-full object-cover object-center absolute opacity-60">
                    <div
                        class="absolute w-full h-full flex flex-col items-center justify-center z-10 p-6 sm:p-8 text-center">
                        <h2 class="text-white font-medium text-3xl sm:text-4xl">250+ Seller</h2>
                        <p class="text-white mt-4 max-w-sm">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo excepturi fugit.
                        </p>
                        <button
                            class="rounded-full bg-white border border-slate-200 cursor-pointer focus:ring-1 focus:ring-slate-300 py-2 px-4 hover:bg-slate-50 mt-4">
                            View More
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Fitur 1 -->
                <div class="w-full flex flex-col gap-2 rounded-xl bg-Whisper-50 p-4">
                    <div class="h-12 w-12 p-2 bg-white rounded-full flex items-center justify-center">
                        <i data-feather="scissors" class="text-thunder-950"></i>
                    </div>
                    <h4 class="text-slate-700 font-semibold mt-2 text-lg">Pesan Jahitan Lebih Mudah</h4>
                    <p class="text-slate-600 font-medium text-sm">
                        Pilih model dan kain favoritmu, lalu pesan langsung dari rumah tanpa harus datang ke penjahit.
                    </p>
                </div>

                <!-- Fitur 2 -->
                <div class="w-full flex flex-col gap-2 rounded-xl bg-Whisper-50 p-4">
                    <div class="h-12 w-12 p-2 bg-white rounded-full flex items-center justify-center">
                        <i data-feather="layers" class="text-thunder-950"></i>
                    </div>
                    <h4 class="text-slate-700 font-semibold mt-2 text-lg">Pilihan Kain Lengkap</h4>
                    <p class="text-slate-600 font-medium text-sm">
                        Tersedia berbagai jenis kain premium, dengan stok per meter yang dapat dicek langsung.
                    </p>
                </div>

                <!-- Fitur 3 -->
                <div class="w-full flex flex-col gap-2 rounded-xl bg-Whisper-50 p-4">
                    <div class="h-12 w-12 p-2 bg-white rounded-full flex items-center justify-center">
                        <i data-feather="sliders" class="text-thunder-950"></i>
                    </div>
                    <h4 class="text-slate-700 font-semibold mt-2 text-lg">Ukuran Custom Otomatis</h4>
                    <p class="text-slate-600 font-medium text-sm">
                        Sistem akan menghitung kebutuhan kain otomatis sesuai model dan ukuran tubuh pelanggan.
                    </p>
                </div>

                <!-- Fitur 4 -->
                <div class="w-full flex flex-col gap-2 rounded-xl bg-Whisper-50 p-4">
                    <div class="h-12 w-12 p-2 bg-white rounded-full flex items-center justify-center">
                        <i data-feather="truck" class="text-thunder-950"></i>
                    </div>
                    <h4 class="text-slate-700 font-semibold mt-2 text-lg">Pengiriman Tepat Waktu</h4>
                    <p class="text-slate-600 font-medium text-sm">
                        Pantau status pengerjaan jahitan dan nikmati pengiriman ke rumah yang cepat dan aman.
                    </p>
                </div>
            </div>
        </section>
        <section class="w-full max-w-7xl px-8 py-12 bg-white mx-auto">
            <h2 class="font-medium text-2xl sm:text-3xl text-slate-700 text-center">Frequently Asked Question</h2>
            <p class="text-center mt-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae, quia!</p>
            <div id="accordion-open" data-accordion="open" class="mt-8 max-w-5xl mx-auto">
                <!-- FAQ 1 -->
                <h2 id="accordion-open-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-gray-700 border border-b-0 border-gray-200 rounded-t-xl hover:bg-gray-100 gap-3 aria-expanded:bg-slate-800"
                        data-accordion-target="#accordion-open-body-1" aria-expanded="true"
                        aria-controls="accordion-open-body-1">
                        <span class="flex items-center gap-2">
                            <i data-feather="help-circle" class="w-5 h-5 me-2 text-slate-600"></i>
                            Bagaimana cara memesan jahitan?
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="mb-2 text-gray-600">
                            Anda cukup memilih jenis produk (kemeja, gamis, dll), pilih kain dan ukuran, lalu lakukan
                            checkout. Kami akan menghubungi Anda untuk konfirmasi detail sebelum produksi dimulai.
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <h2 id="accordion-open-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-gray-700 border border-b-0 border-gray-200 hover:bg-gray-100 gap-3 aria-expanded:bg-slate-800"
                        data-accordion-target="#accordion-open-body-2" aria-expanded="false"
                        aria-controls="accordion-open-body-2">
                        <span class="flex items-center gap-2">
                            <i data-feather="scissors" class="w-5 h-5 me-2 text-slate-600"></i>
                            Apakah saya bisa memilih kain sendiri?
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="text-gray-600">
                            Ya, kami menyediakan berbagai pilihan kain yang bisa Anda pilih saat melakukan pemesanan.
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <h2 id="accordion-open-heading-3">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-gray-700 border border-gray-200 hover:bg-gray-100 gap-3 aria-expanded:bg-slate-800"
                        data-accordion-target="#accordion-open-body-3" aria-expanded="false"
                        aria-controls="accordion-open-body-3">
                        <span class="flex items-center gap-2">
                            <i data-feather="maximize-2" class="w-5 h-5 me-2 text-slate-600"></i>
                            Bagaimana jika saya tidak tahu ukuran saya?
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200">
                        <p class="text-gray-600">
                            Tenang, kami menyediakan panduan pengukuran yang mudah diikuti. Anda juga bisa memasukkan ukuran
                            secara manual.
                        </p>
                    </div>
                </div>
            </div>



        </section>
    </div>
@endsection
