@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">Account Detail</h1>
        </div>
        <div class="w-full max-w-7xl px-8 py-12 mx-auto">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Avatar -->
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    @php
                        $user = auth('customer')->user();
                        $profileUrl = $user->profile
                            ? asset('storage/' . $user->profile)
                            : 'https://api.dicebear.com/9.x/initials/svg?seed=' . urlencode($user->name);
                    @endphp
                    <img class="w-20 h-20 rounded-full object-cover" src="{{ $profileUrl }}" alt="Avatar">
                    <div class="w-full">
                        <label class="block mb-1 text-base font-medium text-gray-900">Change avatar</label>
                        <input type="file" name="avatar"
                            class="block w-full text-sm text-gray-500 px-4 file:py-1.5 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-slate-200 file:text-blue-700
                                hover:file:bg-slate-300" />
                        <p class="mt-2 text-xs text-gray-500">JPG, GIF or PNG. 1MB max.</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    <!-- Left Column -->
                    <div class="w-full md:w-1/2 space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-900">Fullname</label>
                            <input type="text" id="name" name="name"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="John" required value="{{ $user->name }}">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                            <input type="email" id="email" name="email"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white read-only:bg-slate-100 p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="you@example.com" required value="{{ $user->email }}" readonly>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-900">Phone</label>
                            <input type="text" id="phone" name="phone"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                required value="{{ $user->phone }}">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-900">Address</label>
                            <textarea id="address" name="address" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Address">{{ $user->address }}</textarea>
                        </div>

                        <!-- Submit Info -->
                        <div class="pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="w-full md:w-1/2 space-y-4">
                        <div>
                            <label for="oldPassword" class="block text-sm font-medium text-gray-900">Old Password</label>
                            <input type="password" id="oldPassword" name="oldPassword"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="*******" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-900">New Password</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="*******" required>
                        </div>

                        <!-- Submit Password -->
                        <div class="pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Password
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
