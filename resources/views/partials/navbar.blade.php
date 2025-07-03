<nav x-data="{ scrolled: false, open: false }" x-init="scrolled = window.scrollY > 10" @scroll.window="scrolled = window.scrollY > 10"
    :class="scrolled ? 'bg-white shadow-none md:shadow py-5 ' : 'bg-white md:bg-transparent py-5 md:py-8 '"
    class="w-full fixed z-50 transition-all duration-300 ease-in-out">
    <div class="max-w-7xl px-6 mx-auto flex justify-between md:justify-center items-center relative">
        <!-- Logo -->
        <h1 class="text-slate-700 text-2xl font-bold block md:absolute md:left-6">Rujha</h1>

        <!-- Desktop Nav -->
        <ul class="hidden md:flex gap-6 items-center">
            <li>
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('products') }}"
                    class="{{ request()->routeIs('products') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Product
                </a>
            </li>
            <li>
                <a href="/"
                    class="{{ request()->routeIs('training') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Training
                </a>
            </li>
            <li>
                <a href="/"
                    class="{{ request()->routeIs('about') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    About
                </a>
            </li>
        </ul>

        <!-- Right actions -->
        <div class="hidden md:flex items-center gap-4 md:absolute md:right-0">
            <a href="{{ route('products.search') }}"
                class="rounded-full h-10 w-10 bg-white border border-slate-200 flex items-center justify-center focus:ring-1 focus:ring-slate-300 p-[10px] cursor-pointer">
                <i data-feather="search" class="text-slate-700"></i>
            </a>
            <button
                class="rounded-full h-10 w-10 bg-white border border-slate-200 flex items-center justify-center focus:ring-1 focus:ring-slate-300 p-[10px] cursor-pointer">
                <i data-feather="shopping-bag" class="text-slate-700"></i>
            </button>
            <button
                class="rounded-full h-10 w-auto bg-white border border-slate-200 flex gap-2 items-center justify-center focus:ring-1 focus:ring-slate-300 py-[10px] px-4 cursor-pointer">
                <i data-feather="user" class="text-slate-700"></i>
                <h4>Login</h4>
            </button>
        </div>

        <!-- Mobile Hamburger -->
        <button @click="open = !open" class="md:hidden block">
            <template x-if="!open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </template>
            <template x-if="open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </template>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="md:hidden bg-white">
        <ul class="flex flex-col p-6 gap-4 items-center w-full">
            <li>
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'font-bold text-amber-900' : 'text-slate-700' }} w-full">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('products') }}"
                    class="{{ request()->routeIs('products') ? 'font-bold text-amber-900' : 'text-slate-700' }} w-full">
                    Product
                </a>
            </li>
            <li>
                <a href="/"
                    class="{{ request()->routeIs('training') ? 'font-bold text-amber-900' : 'text-slate-700' }} w-full">
                    Training
                </a>
            </li>
            <li>
                <a href="/"
                    class="{{ request()->routeIs('about') ? 'font-bold text-amber-900' : 'text-slate-700' }} w-full">
                    About
                </a>
            </li>
            <li>
                <button class="flex items-center gap-2 mt-2 text-slate-700 w-full">
                    <i data-feather="user"></i> Login
                </button>
            </li>
        </ul>
    </div>
</nav>
