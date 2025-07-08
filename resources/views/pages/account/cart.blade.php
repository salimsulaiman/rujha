@extends('layout.app')
@section('content')
    <div class="w-full">
        <div class="w-full h-[300px] bg-cover bg-center flex flex-col items-center justify-center"
            style="background-image: url('/assets/images/batik-bg.jpg');">
            <h1 class="text-slate-600 font-semibold text-4xl mt-12">Shopping Cart</h1>
        </div>
        <section class="bg-white py-8 antialiased md:py-16 w-full">
            <div class="mx-auto max-w-7xl px-8 md:px-8" x-data x-ref="cartRoot">
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    @if ($cart && $cart->items->count())
                        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                            <div class="space-y-6">

                                @foreach ($cart->items as $item)
                                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6"
                                        x-data="{
                                            quantity: {{ $item->quantity }},
                                            itemId: {{ $item->id }},
                                            requestedMeter: {{ $item->requested_meter }},
                                            pricePerMeter: {{ $item->variant->price_per_meter }},
                                            availableStock: {{ $item->variant->stock_in_meter }},
                                        
                                            get totalPrice() {
                                                return this.quantity * this.requestedMeter * this.pricePerMeter;
                                            },
                                            formatRupiah(val) {
                                                return 'Rp ' + Number(val).toLocaleString('id-ID');
                                            },
                                            updateQuantity(newQty) {
                                                fetch('{{ route('cart-items.updateQuantity', ':id') }}'.replace(':id', this.itemId), {
                                                        method: 'PATCH',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({ quantity: newQty })
                                                    })
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        if (data.deleted) {
                                                            window.location.reload();
                                                        } else if (!data.success) {
                                                            alert(data.message ?? 'Terjadi kesalahan.');
                                                            this.quantity--; // kembalikan jika gagal
                                                        }
                                                    });
                                            }
                                        }">
                                        <div
                                            class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                            <div href="#"
                                                class="shrink-0 md:order-1 h-20 w-20 rounded-lg overflow-hidden">
                                                <img class="w-full h-full object-cover object-center"
                                                    src="{{ asset('storage/' . $item->variant->images->first()->image) }}"
                                                    alt="imac image" />
                                            </div>

                                            <label for="counter-input" class="sr-only">Choose quantity:</label>
                                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                                <div class="flex items-center">
                                                    <button type="button"
                                                        @click="
                                                        if (quantity > 1) {
                                                            quantity--;
                                                        } else {
                                                            quantity = 1;
                                                        }
                                                        updateQuantity(quantity);
                                                        $store.cart.updateQuantity(itemId, quantity);
                                                    "
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200">
                                                        <svg class="h-2.5 w-2.5 text-gray-900"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                        </svg>
                                                    </button>


                                                    <input type="text" x-model="quantity"
                                                        @change="
                                                    if (quantity < 1) quantity = 1;
                                                    updateQuantity(quantity);
                                                    $refs.cartRoot.updateItemQuantity(itemId, quantity);
                                                "
                                                        readonly
                                                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:ring-0" />

                                                    <button type="button"
                                                        @click="
                                                            let totalMeter = (quantity + 1) * requestedMeter;
                                                            if (totalMeter > availableStock) {
                                                                alert('Stok tidak mencukupi untuk menambah jumlah ini.');
                                                                return;
                                                            }
                                                            quantity++;
                                                            updateQuantity(quantity);
                                                            $store.cart.updateQuantity(itemId, quantity);
                                                        "
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200">
                                                        <svg class="h-2.5 w-2.5 text-gray-900"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M9 1v16M1 9h16" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="text-end md:order-4 md:w-32 flex flex-col gap-1">
                                                    <p class="text-xs font-normal text-gray-600">
                                                        <span x-text="formatRupiah(pricePerMeter)"></span> * <span
                                                            x-text="(requestedMeter * quantity).toFixed(2)"></span>m
                                                    </p>
                                                    <p class="text-base font-bold text-gray-900">
                                                        <span x-text="formatRupiah(totalPrice)"></span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                                <div class="flex flex-col gap-2">
                                                    <a href="{{ route('product.detail', $item->product->slug) }}"
                                                        class="text-lg font-semibold text-gray-900 hover:underline w-fit">{{ $item->product->name }}</a>
                                                    <div class="flex gap-2">
                                                        <div
                                                            class="text-xs font-medium text-gray-900 px-4 py-1 rounded-full bg-slate-200 w-fit flex items-center justify-center">
                                                            {{ $item->variant->name }}</div>
                                                        <div
                                                            class="text-xs font-medium text-gray-900 px-4 py-1 rounded-full bg-slate-200 w-fit flex items-center justify-center">
                                                            {{ $item->size?->size_label ?? 'Custom' }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4 mt-4">
                                                    <form action="{{ route('cart.item.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="items-center text-sm font-medium text-red-600 gap-1 flex cursor-pointer">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                stroke-width="1.5" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 7h12M9 7v10m6-10v10M4 7h16M10 3h4a1 1 0 0 1 1 1v1H9V4a1 1 0 0 1 1-1zM5 7l1 12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1l1-12" />
                                                            </svg>
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                            <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                                <p class="text-xl font-semibold text-gray-900 ">Order summary</p>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500">Original price</dt>
                                            <dd x-text="$store.cart.formatRupiah($store.cart.originalPrice)"></dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500">Tax</dt>
                                            <dd x-text="$store.cart.formatRupiah($store.cart.tax)"></dd>

                                        </dl>
                                    </div>

                                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                                        <dt class="text-base font-bold text-gray-900 ">Total</dt>
                                        <dd x-text="$store.cart.formatRupiah($store.cart.total)"></dd>
                                    </dl>
                                </div>
                                @if (session('error'))
                                    <div class="text-red-600 font-medium">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('checkout') }}" method="POST" x-data>
                                    @csrf
                                    <input type="hidden" name="subtotal_amount" id=""
                                        :value="$store.cart.originalPrice">
                                    <input type="hidden" name="tax" id="" :value="$store.cart.tax">
                                    <input type="hidden" name="total_amount" id="" :value="$store.cart.total">
                                    <button type="submit"
                                        class="flex w-full items-center justify-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                        Proceed
                                        to Checkout</button>
                                </form>

                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                    <a href="#" title=""
                                        class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                        Continue Shopping
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full bg-white min-h-[200px] flex items-center justify-center">
                            <p class="w-full text-slate-700 text-center">Tidak ada item di keranjang</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @if (session('success'))
            <div x-data="{ showToast: true }" x-init="setTimeout(() => showToast = false, 3000)" x-show="showToast" id="toast-interactive"
                class="w-full max-w-xs p-4 text-gray-700 bg-red-50 rounded-lg shadow-sm fixed right-8 bottom-8"
                role="alert" x-transition>
                <div class="flex gap-1">
                    <div
                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-200 rounded-lg shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 7h12M9 7v10m6-10v10M4 7h16M10 3h4a1 1 0 0 1 1 1v1H9V4a1 1 0 0 1 1-1zM5 7l1 12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1l1-12" />
                        </svg>
                        <span class="sr-only">Refresh icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">
                        <span class="mb-1 text-sm font-semibold text-gray-900">Item dihapus</span>
                        <div class="mb-2 text-sm font-normal">{{ session('success') }}</div>
                    </div>
                    <button @click="showToast = false"
                        class="ms-auto text-gray-400 hover:text-gray-900 rounded-lg p-1 h-8 w-8 shrink-0 flex items-center justify-center"
                        aria-label="Close">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        @if (session('successOrder'))
            <div x-data="{ showToast: true }" x-show="showToast" id="toast-interactive"
                class="w-full max-w-xs p-4 text-gray-700 bg-green-50 rounded-lg shadow-sm fixed right-8 bottom-8"
                role="alert" x-transition>
                <div class="flex gap-1">
                    <div
                        class="inline-flex items-center justify-center w-8 h-8 text-green-600 bg-green-100 rounded-lg shrink-0 p-2">
                        <i data-feather="dollar-sign"></i>

                        <span class="sr-only">Refresh icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">
                        <span class="mb-1 text-sm font-semibold text-gray-900">Success</span>
                        <div class="mb-2 text-sm font-normal">{{ session('successOrder') }}</div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <a href="{{ route('transaction') }}"
                                    class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-white bg-slate-700 rounded-lg hover:bg-slate-800 focus:ring-2 focus:ring-slate-300">
                                    Detail
                                </a>
                            </div>
                            <div>
                                <button @click="showToast = false"
                                    class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-gray-200">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                    <button @click="showToast = false"
                        class="ms-auto text-gray-400 hover:text-gray-900 rounded-lg p-1 h-8 w-8 shrink-0 flex items-center justify-center"
                        aria-label="Close">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        @php
            $cartSummaryItems = [];
            if ($cart && $cart->items) {
                $cartSummaryItems = $cart->items
                    ->map(function ($i) {
                        return [
                            'id' => $i->id,
                            'quantity' => $i->quantity,
                            'requestedMeter' => $i->requested_meter,
                            'pricePerMeter' => $i->variant->price_per_meter,
                        ];
                    })
                    ->values()
                    ->toArray();
            }
        @endphp
        <script>
            function cartSummary() {
                return {
                    items: {!! json_encode($cartSummaryItems) !!},
                    updateItemQuantity(id, newQty) {
                        const item = this.items.find(i => i.id === id);
                        if (item) item.quantity = newQty;
                    },
                    get originalPrice() {
                        return this.items.reduce((sum, i) => {
                            return sum + (i.quantity * i.requestedMeter * i.pricePerMeter);
                        }, 0);
                    },
                    get tax() {
                        return this.originalPrice * 0.1;
                    },
                    get total() {
                        return this.originalPrice + this.tax;
                    },
                    formatRupiah(val) {
                        return 'Rp ' + Number(val).toLocaleString('id-ID');
                    },
                    init() {
                        this.items = Alpine.reactive(this.items);
                    }
                };
            }
        </script>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('cart', {
                    items: Alpine.reactive({{ Js::from($cartSummaryItems) }}),

                    updateQuantity(id, newQty) {
                        const item = this.items.find(i => i.id === id);
                        if (item) item.quantity = newQty;
                    },

                    get originalPrice() {
                        return this.items.reduce((sum, i) => sum + (i.quantity * i.requestedMeter * i
                            .pricePerMeter), 0);
                    },

                    get tax() {
                        return this.originalPrice * 0.1;
                    },

                    get total() {
                        return this.originalPrice + this.tax;
                    },

                    formatRupiah(val) {
                        return 'Rp ' + Number(val).toLocaleString('id-ID');
                    }
                });
            });
        </script>

    </div>
@endsection
