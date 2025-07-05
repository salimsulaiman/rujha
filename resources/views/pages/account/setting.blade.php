@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">Account Detail</h1>
        </div>
        @if (session('success'))
            <div class="w-full max-w-7xl px-8 pt-8 mx-auto">
                <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 font-medium" role="alert">
                    <span class="font-semibold">Success!</span> {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="w-full max-w-7xl px-8 py-12 mx-auto">
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
                    <div class="flex gap-2 items-center justify-center md:justify-start">
                        <button data-modal-target="update-profile" data-modal-toggle="update-profile"
                            class="block mb-1 font-medium px-3 py-2 bg-slate-200 rounded-xl text-sm text-slate-700 hover:bg-slate-300 cursor-pointer">Change
                            avatar</button>
                        <form action="{{ route('setting.delete.profile') }}" method="post">
                            @csrf
                            <button type="submit"
                                class="block mb-1 font-medium px-3 py-2 bg-red-400 rounded-xl text-sm text-white hover:bg-red-500 cursor-pointer">Delete
                                avatar</button>
                        </form>
                    </div>
                    <div id="update-profile" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Update Profile
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="update-profile">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <form action="{{ route('setting.update.profile') }}" method="POST"
                                    enctype="multipart/form-data" x-data="uploadPreview()" class="space-y-4">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 font-medium">
                                        <div class="flex flex-col items-center justify-center w-full">
                                            <div
                                                class="relative w-full h-64 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100">
                                                <!-- Delete Button di luar label -->
                                                <template x-if="imageUrl">
                                                    <button type="button" @click="removeImage;"
                                                        class="absolute top-2 right-2 z-20 bg-red-500 rounded-full p-1 hover:bg-red-600 flex items-center justify-center h-6 w-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6" />
                                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                            <path d="M10 11v6" />
                                                            <path d="M14 11v6" />
                                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                    </button>
                                                </template>

                                                <!-- Label Dropzone -->
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer relative">

                                                    <!-- Image Preview -->
                                                    <template x-if="imageUrl">
                                                        <div class="flex items-center justify-center w-full h-full">
                                                            <img :src="imageUrl" alt="Preview"
                                                                class="w-32 h-32 object-cover rounded-lg mb-2" />
                                                        </div>
                                                    </template>

                                                    <!-- Default Placeholder -->
                                                    <template x-if="!imageUrl">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 20 16">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                                                                                                                                                                                                                                           5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4
                                                                                                                                                                                                                                           4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                            </svg>
                                                            <p class="mb-2 text-sm text-gray-500"><span
                                                                    class="font-semibold">Click to upload</span> or drag and
                                                                drop</p>
                                                            <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX.
                                                                800x400px)</p>
                                                        </div>
                                                    </template>

                                                    <!-- Hidden Input -->
                                                    <input id="dropzone-file" type="file" name="profile" class="hidden"
                                                        accept="image/*" @change="previewImage" />
                                                </label>
                                            </div>


                                            <template x-if="fileName">
                                                <p class="mt-2 text-sm text-gray-600" x-text="fileName"></p>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b justify-end">
                                        <button type="submit"
                                            class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Update
                                        </button>
                                        <button data-modal-hide="update-profile" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 text-center md:text-start">JPG or PNG. 1MB max.</p>
                </div>
            </div>
            <!-- Content -->
            <div class="flex flex-col md:flex-row justify-between gap-6 mt-8">
                <!-- Left Column -->
                <form action="{{ route('setting.update.detail') }}" method="POST" class="w-full md:w-1/2">
                    @csrf
                    <div class="w-full space-y-4">
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
                </form>
                <!-- Right Column -->
                <form action="{{ route('setting.update.password') }}" method="POST" class="w-full md:w-1/2">
                    @csrf
                    <div class="w-full space-y-4">
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
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="*******" required>
                        </div>
                        @if ($errors->any())
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 font-medium" role="alert"">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Submit Password -->
                        <div class="pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <script>
        function uploadPreview() {
            return {
                imageUrl: null,
                fileName: null,
                previewImage(event) {
                    const file = event.target.files[0];

                    if (file.size > 1024 * 1024) {
                        alert("Ukuran gambar maksimal 1MB");
                        event.target.value = ""; // reset input
                        this.imageUrl = null;
                        return;
                    }

                    if (file) {
                        this.fileName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imageUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
                removeImage() {
                    this.imageUrl = null;
                    this.fileName = null;
                    document.getElementById('dropzone-file').value = null;
                }
            };
        }
    </script>
@endsection
