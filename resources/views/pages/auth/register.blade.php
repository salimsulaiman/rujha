@extends('layout.app')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 w-full bg-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{ route('home') }}" class="text-thunder-950 text-4xl font-bold text-center block">rujha</a>
            <h2 class="mt-4 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign up your account</h2>
            @if (session('success'))
                <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 font-medium" role="alert">
                    <span class="font-semibold">Success!</span> {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Fullname</label>
                    <input type="text" id="first_name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="John" required />
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="text" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="john@example.com" required />
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required />
                </div>


                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-slate-800 px-3 py-1.5 text-base/6 font-semibold text-white shadow-xs hover:bg-slate-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">Daftar</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Have an account?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Login here</a>
            </p>
        </div>
    </div>
@endsection
