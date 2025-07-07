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
                        <a href="{{ route('training.detail') }}"
                            class="rounded-full bg-thunder-950 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-slate-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">Get
                            started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
