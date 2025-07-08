@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div
                        class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span
                                class="absolute inset-0" aria-hidden="true"></span>Read more <span
                                aria-hidden="true">&rarr;</span></a>
                    </div>
                </div>
                <div class="text-center">
                    <h1
                        class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-4xl leading-relaxed">
                        Empower Your
                        Online Business with Professional Sewing Skills</h1>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Learn how to sew and turn
                        your hobby into a real business. Our training is easy to follow — perfect for beginners who want to
                        sell custom clothes or start a tailoring service online.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="#"
                            class="rounded-full bg-thunder-950 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-slate-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">Get
                            started</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-7xl px-8 py-16">
            <div class="w-full grid grid-cols-4 gap-4">
                @forelse ($trainings as $training)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <div class="w-full h-[200px] overflow-hidden bg-slate-100 relative">
                            <img class="h-full w-full absolute object-cover object-center"
                                src="{{ asset('storage/' . $training->thumbnail) }}" alt="" />
                        </div>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 line-clamp-2">
                                    {{ $training->title }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 line-clamp-3">{{ $training->excerpt }}</p>
                            <a href="{{ route('training.detail', $training->slug) }}"
                                class="inline-flex w-full justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-slate-700 rounded-lg hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300">
                                Selengkapnya
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="w-full col-span-4 flex justify-center h-[100px]">
                        <p>Data training kosong</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
