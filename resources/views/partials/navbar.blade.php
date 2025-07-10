<nav x-data="{ scrolled: false, open: false }" x-init="scrolled = window.scrollY > 10" @scroll.window="scrolled = window.scrollY > 10"
    :class="scrolled ? 'bg-white shadow-none md:shadow py-5 ' : 'bg-white md:bg-transparent py-5 md:py-8 '"
    class="w-full fixed z-40 transition-all duration-300 ease-in-out">
    <div class="max-w-7xl px-6 mx-auto flex justify-between md:justify-center items-center relative">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-slate-700 text-2xl font-bold block md:absolute md:left-6">rujha</a>

        <!-- Desktop Nav -->
        <ul class="hidden md:flex gap-6 items-center">
            <li>
                <a href="{{ route('home') }}"
                    class="{{ request()->is('/') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('products') }}"
                    class="{{ request()->is('*products*') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Product
                </a>
            </li>
            <li>
                <a href="{{ route('training') }}"
                    class="{{ request()->is('*training*') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    Training
                </a>
            </li>
            <li>
                <a href="/"
                    class="{{ request()->is('*about*') ? 'font-bold border-b-2 border-slate-700 text-amber-900 pb-2' : 'text-slate-500 hover:text-slate-700' }}">
                    About
                </a>
            </li>
        </ul>

        <!-- Right actions -->
        <div class="hidden md:flex items-center gap-4 md:absolute md:right-8">
            <button data-modal-target="modal-search" data-modal-toggle="modal-search"
                class="rounded-full h-10 w-10 bg-white border border-slate-200 flex items-center justify-center focus:ring-1 focus:ring-slate-300 p-[10px] cursor-pointer">
                <i data-feather="search" class="text-slate-700"></i>
            </button>
            <a href="{{ route('cart') }}"
                class="rounded-full h-10 w-10 bg-white border border-slate-200 flex items-center justify-center focus:ring-1 focus:ring-slate-300 p-[10px] cursor-pointer">
                <i data-feather="shopping-bag" class="text-slate-700"></i>
            </a>
            @if (auth('customer')->check())
                <div>
                    @php
                        $user = auth('customer')->user();
                        $profileUrl = $user->profile
                            ? asset('storage/' . $user->profile)
                            : 'https://api.dicebear.com/9.x/initials/svg?seed=' . urlencode($user->name);
                    @endphp

                    <div class="w-10 h-10 relative rounded-full overflow-hidden">
                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                            data-dropdown-placement="bottom-start"
                            class="absolute h-full w-full object-cover object-center cursor-pointer"
                            src="{{ $profileUrl }}" alt="User dropdown">
                    </div>

                    <!-- Dropdown menu -->
                    <div id="userDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div>{{ auth('customer')->user()->name }}</div>
                        </div>
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="avatarButton">
                            <li>
                                <a href="{{ route('setting') }}" class="block px-4 py-2 hover:bg-gray-100">Account</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100 cursor-pointer">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-full h-10 w-auto bg-white border border-slate-200 flex gap-2 items-center justify-center focus:ring-1 focus:ring-slate-300 py-[10px] px-4 cursor-pointer">
                    <i data-feather="user" class="text-slate-700"></i>
                    <h4>Login</h4>
                </a>
            @endif
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
                <a href="{{ route('login') }}" class="flex items-center gap-2 mt-2 text-slate-700 w-full">
                    <i data-feather="user"></i> Login
                </a>
            </li>
        </ul>
    </div>
</nav>

<div id="modal-search" x-data x-init="const observer = new MutationObserver(() => {
    if ($el.classList.contains('flex')) {
        $nextTick(() => $refs.inputSearch.focus())
    }
});
observer.observe($el, { attributes: true, attributeFilter: ['class'] });" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-full overflow-hidden shadow-sm p-2">

            <form class="flex items-center mx-auto" action="{{ route('products') }}" method="GET">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="search" x-ref="inputSearch" id="simple-search" name="search" autofocus
                        class="bg-white text-gray-900 text-sm rounded-full focus:ring-0 border-0 block w-full ps-10 p-2.5"
                        placeholder="Search product name..." />
                </div>
                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-slate-700 rounded-full border border-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>


        </div>
    </div>
</div>
