@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">Product Detail</h1>
        </div>
        <div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10 w-full">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col-reverse lg:flex-row gap-4">
                    <!-- Thumbnails -->
                    <div class="flex lg:flex-col gap-3">
                        <img src="{{ asset('assets/images/man.jpg') }}" class="w-16 h-16 object-cover rounded cursor-pointer"
                            alt="">
                        <img src="{{ asset('assets/images/man.jpg') }}"
                            class="w-16 h-16 object-cover rounded cursor-pointer" alt="">
                        <img src="{{ asset('assets/images/man.jpg') }}"
                            class="w-16 h-16 object-cover rounded cursor-pointer" alt="">
                    </div>
                    <!-- Main Image -->
                    <div class="flex-1">
                        <img src="{{ asset('assets/images/man.jpg') }}" class="w-full rounded-lg object-cover"
                            alt="">
                    </div>
                </div>
                <div class="w-full mt-8">
                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <h2 id="accordion-flush-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
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
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of
                                    interactive components built on top of Tailwind CSS including buttons, dropdowns,
                                    modals, navbars, and more.</p>
                                <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a
                                        href="/docs/getting-started/introduction/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start
                                    developing websites even faster with components on top of Tailwind CSS.</p>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
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
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and
                                    designed using the Figma software so everything you see in the library has a design
                                    equivalent in our Figma file.</p>
                                <p class="text-gray-500 dark:text-gray-400">Check out the <a
                                        href="https://flowbite.com/figma/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a>
                                    based on the utility classes from Tailwind CSS and components from Flowbite.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Right Side: Product Info -->
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Kemeja Biru Minimalis</h1>

                <!-- Reviews -->
                <div class="flex items-center mt-2 gap-2 text-sm text-gray-600">
                    <span class="text-yellow-500">★ ★ ★ ★ ☆</span>
                    <span>345 Reviews</span>
                </div>

                <!-- Price -->
                <div class="mt-4 text-3xl font-bold text-gray-900">Rp. 100.000</div>

                <!-- Quantity -->
                <div class="mt-4">
                    <label for="qty" class="text-base font-medium text-gray-700">Quantity</label>
                    <select id="qty"
                        class="mt-1 block w-20 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="mt-6 space-y-8">
                    <div>
                        <h4 class="text-base font-semibold text-gray-700 mb-1">Variant</h4>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">Green</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">Pink</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">Silver</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">Blue</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-base font-semibold text-gray-700 mb-1">Size</h4>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">S</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">M</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">L</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">XL</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">XXL</span>
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-base cursor-pointer">Custom</span>
                        </div>
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
