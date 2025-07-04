@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">Product Detail</h1>
        </div>
        <div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10 w-full" x-data="{
            selectedVariantId: {{ $product->variants->first()->id }},
            variants: {{ $product->variants->toJson() }},
            activeImage: '',
            formatRupiah(value) {
                return 'Rp ' + Number(value).toLocaleString('id-ID');
            },
            updateActiveImageById(id) {
                const variant = this.variants.find(v => v.id === id);
                this.activeImage = variant?.images?.length ? '/storage/' + variant.images[0].image : '';
            },
            get selectedVariant() {
                return this.variants.find(v => v.id === this.selectedVariantId);
            },
            selectedSize: '',
            showCustomSizeForm: false,
            customSize: {
                chest: null,
                waist: null,
                hip: null,
                body_length: null,
                sleeve_length: null
            }
        }"
            x-init="updateActiveImageById(selectedVariantId)">
            <div class="flex flex-col gap-4">
                @php
                    $variant = $product->variants->first();
                @endphp
                <div class="flex flex-col-reverse lg:flex-row gap-4">
                    <!-- Thumbnails -->
                    <div class="flex lg:flex-col gap-3">
                        <template x-for="(image, i) in selectedVariant.images" :key="i">
                            <img :src="'/storage/' + image.image" @click="activeImage = '/storage/' + image.image"
                                class="w-16 h-16 object-cover rounded cursor-pointer ring-2 ring-transparent hover:ring-blue-400 transition"
                                alt="Thumbnail">
                        </template>
                    </div>
                    <!-- Main Image -->
                    <div class="flex-1 aspect-square relative rounded-lg overflow-hidden">
                        <img :src="activeImage"
                            class="w-full h-full absolute object-center object-cover transition duration-300 ease-in-out"
                            alt="Main Image">
                    </div>
                </div>
                <div class="w-full mt-8">
                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900"
                        data-inactive-classes="text-gray-500">

                        <h2 id="accordion-flush-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3"
                                data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                                aria-controls="accordion-flush-body-1">
                                <span>Description</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                            <div class="py-5 border-b border-gray-200">
                                <p class="mb-2 text-gray-500">{{ $product->description }}</p>
                            </div>
                        </div>

                        <h2 id="accordion-flush-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3"
                                data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                                aria-controls="accordion-flush-body-2">
                                <span>Specification</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                            <div class="py-5 border-b border-gray-200">
                                <p class="mb-2 text-gray-500">Flowbite is first conceptualized and
                                    designed using the Figma software so everything you see in the library has a design
                                    equivalent in our Figma file.</p>
                                <p class="text-gray-500">Check out the <a href="https://flowbite.com/figma/"
                                        class="text-blue-600 hover:underline">Figma design system</a>
                                    based on the utility classes from Tailwind CSS and components from Flowbite.</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <!-- Right Side: Product Info -->
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h1>

                <!-- Reviews -->
                <div class="flex items-center mt-2 gap-2 text-sm text-gray-600">
                    <span class="text-yellow-500">★ ★ ★ ★ ☆</span>
                    <span>345 Reviews</span>
                </div>

                <!-- Price -->
                <div class="mt-4 text-3xl font-bold text-gray-900">
                    <span x-text="formatRupiah(selectedVariant?.price_per_meter)"></span>/m
                </div>
                <div class="w-full mt-4">
                    <h4 class="text-base font-semibold text-gray-700 mb-1">Quantity</h4>
                    <div class="relative flex items-center max-w-[8rem]">
                        <!-- Minus Button -->
                        <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 1h16" />
                            </svg>
                        </button>

                        <!-- Input -->
                        <input type="text" id="quantity-input" data-input-counter
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm block w-full py-2.5 focus:outline-none"
                            placeholder="0" required value="1" />

                        <!-- Plus Button -->
                        <button type="button" id="increment-button" data-input-counter-increment="quantity-input"
                            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-6 space-y-8">
                    <div>
                        <h4 class="text-base font-semibold text-gray-700 mb-1 flex items-center gap-2">
                            Variant
                            <span class="text-sm font-normal text-gray-500 ml-2"
                                x-text="`Stok: ${selectedVariant?.stock_in_meter ?? 0}m`"></span>
                        </h4>
                        <div class="flex gap-2">
                            <template x-for="variant in variants" :key="variant.id">
                                <span @click="selectedVariantId = variant.id; updateActiveImageById(variant.id)"
                                    x-text="variant.name"
                                    :class="selectedVariantId === variant.id ?
                                        'bg-slate-700 text-white' :
                                        'bg-gray-100 text-gray-900'"
                                    class="px-3 py-1 rounded-full text-base cursor-pointer transition-all duration-150">
                                </span>
                            </template>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-base font-semibold text-gray-700 mb-1 flex items-center gap-2">
                            Size
                            <span class="text-sm font-normal text-gray-500 ml-2"
                                x-show="selectedVariant?.sizes.find(s => s.id === selectedSize)?.estimated_meter > 0"
                                x-text="`Estimasi: ${selectedVariant?.sizes.find(s => s.id === selectedSize)?.estimated_meter ?? 0}m`">
                            </span>
                        </h4>
                        <div class="flex gap-2">
                            <template x-for="size in selectedVariant?.sizes" :key="size.id">
                                <span
                                    @click="size.estimated_meter <= selectedVariant.stock_in_meter ? (selectedSize = size.id, showCustomSizeForm = false) : null"
                                    x-text="size.size_label"
                                    :class="[
                                        size.estimated_meter > selectedVariant.stock_in_meter ?
                                        'bg-gray-200 text-gray-400 cursor-not-allowed' :
                                        (selectedSize === size.id ?
                                            'bg-slate-700 text-white' :
                                            'bg-gray-100 text-gray-900'),
                                        'px-3 py-1 rounded-full text-base transition'
                                    ]"
                                    class="cursor-pointer">
                                </span>
                            </template>

                            @if ($product->is_customable)
                                <span @click="selectedSize = 'custom'; showCustomSizeForm = true"
                                    :class="selectedSize === 'custom'
                                        ?
                                        'bg-slate-700 text-white' :
                                        'bg-gray-100 text-gray-900'"
                                    class="px-3 py-1 rounded-full text-base cursor-pointer transition">
                                    Custom
                                </span>
                            @endif
                        </div>

                        @if ($product->is_customable)
                            <div x-show="showCustomSizeForm" class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="chest" class="block mb-1 text-sm font-semibold text-gray-700">Lingkar
                                        Dada
                                        (cm)</label>
                                    <input type="number" name="chest" id="chest" min="0" step="0.01"
                                        x-model.number="customSize.chest"
                                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="waist" class="block mb-1 text-sm font-semibold text-gray-700">Lingkar
                                        Pinggang (cm)</label>
                                    <input type="number" name="waist" id="waist" min="0" step="0.01"
                                        x-model.number="customSize.waist"
                                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="hip" class="block mb-1 text-sm font-semibold text-gray-700">Lingkar
                                        Pinggul
                                        (cm)</label>
                                    <input type="number" name="hip" id="hip" min="0" step="0.01"
                                        x-model.number="customSize.hip"
                                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="body_length"
                                        class="block mb-1 text-sm font-semibold text-gray-700">Panjang
                                        Badan (cm)</label>
                                    <input type="number" name="body_length" id="body_length" min="0"
                                        step="0.01" x-model.number="customSize.body_length"
                                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="sleeve_length"
                                        class="block mb-1 text-sm font-semibold text-gray-700">Panjang
                                        Lengan (cm)</label>
                                    <input type="number" name="sleeve_length" id="sleeve_length" min="0"
                                        step="0.01" x-model.number="customSize.sleeve_length"
                                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="mt-8 flex gap-2">
                        <button
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-full w-fit hover:bg-blue-700 cursor-pointer">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
