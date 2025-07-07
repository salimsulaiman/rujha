@extends('layout.app')
@section('content')
    <div class="w-full max-w-7xl bg-white px-8 pt-24 pb-16 mx-auto">
        <h1 class="text-2xl text-emerald-700 font-medium">Pelatihan Menjahit Tingkat Dasar</h1>
        <div class="w-full flex gap-12">
            <div class="w-5/7">
                <div class="w-full flex flex-col gap-2 mt-4">
                    <div class="flex gap-2 items-center">
                        <i data-feather="clock"
                            class="size-4 text-emerald-800 group-hover:text-slate-600 transition-colors duration-300 ease-in-out"></i>
                        <h4>10 Juli 2025, 09.00 WIB - 12 Juli 2025, 15.00 WIB</h4>
                    </div>
                    <div class="flex gap-2 items-center">
                        <i data-feather="map-pin"
                            class="size-4 text-emerald-800 group-hover:text-slate-600 transition-colors duration-300 ease-in-out"></i>
                        <h4>Gedung PKK, Jakarta Selatan</h4>
                    </div>
                </div>
                <div class="w-full h-[300px] rounded-xl relative bg-slate-300 mt-4 overflow-hidden">
                    <img src="/storage/images/pelatihan-menjahit.jpg" alt=""
                        class="w-full h-full object-cover object-center absolute">
                </div>
                <div class="flex flex-col gap-2 mt-8">
                    <h2 class="text-slate-600 text-sm uppercase font-medium">Deskripsi</h2>
                    <article class="prose max-w-none w-full text-justify mt-6">
                        <p>
                            Pelatihan menjahit tingkat dasar ini dirancang untuk pemula yang ingin belajar keterampilan
                            dasar menjahit.
                            Dalam pelatihan ini, peserta akan diajarkan teknik-teknik dasar menjahit tangan dan mesin, mulai
                            dari mengenal alat,
                            membaca pola, hingga membuat pakaian sederhana.
                        </p>
                        <p>
                            Kegiatan ini berlangsung selama 3 hari dan terbuka untuk umum. Peserta akan mendapatkan
                            sertifikat serta hasil karya mereka sendiri.
                        </p>
                    </article>
                </div>
            </div>
            <div class="w-2/7">
                <h4 class="text-base text-emerald-700 font-medium">Kegiatan Lainnya</h4>
                <div class="w-full grid grid-cols-1 gap-4">
                    <!-- Event 1 -->
                    <div class="w-full rounded-xl flex flex-col border border-slate-300 overflow-hidden shadow group mt-6">
                        <div class="w-full relative h-[150px] bg-slate-100 overflow-hidden">
                            <img src="/storage/images/event1.jpg" alt=""
                                class="w-full h-full absolute object-center object-cover group-hover:scale-105 transition-all duration-500 ease-in-out">
                        </div>
                        <div class="p-4 flex flex-col gap-2">
                            <a href="/event/pelatihan-menjahit-lanjutan"
                                class="text-base text-slate-600 font-medium line-clamp-2">Pelatihan Menjahit Lanjutan</a>
                            <p class="text-sm line-clamp-2 text-slate-500">Pelajari teknik menjahit tingkat lanjut, seperti
                                pembuatan pola dan pakaian berlapis.</p>
                        </div>
                    </div>
                    <!-- Event 2 -->
                    <div class="w-full rounded-xl flex flex-col border border-slate-300 overflow-hidden shadow group mt-6">
                        <div class="w-full relative h-[150px] bg-slate-100 overflow-hidden">
                            <img src="/storage/images/event2.jpg" alt=""
                                class="w-full h-full absolute object-center object-cover group-hover:scale-105 transition-all duration-500 ease-in-out">
                        </div>
                        <div class="p-4 flex flex-col gap-2">
                            <a href="/event/workshop-desain-busana"
                                class="text-base text-slate-600 font-medium line-clamp-2">Workshop Desain Busana</a>
                            <p class="text-sm line-clamp-2 text-slate-500">Ikuti workshop singkat untuk mempelajari
                                dasar-dasar desain busana yang kreatif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
