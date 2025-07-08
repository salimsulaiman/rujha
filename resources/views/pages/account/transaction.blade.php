@extends('layout.account.app')
@section('content')
    <div class="w-full">
        <div class="w-full max-w-7xl px-2 lg:px-8 py-8 mx-auto">
            <table id="search-table">
                <thead>
                    <tr>
                        <th>
                            <span class="flex items-center">
                                Order Id
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Total
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Status
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Payment Method
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap">{{ $order->code }}</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td><span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-3 py-1 rounded-full">{{ $order->status }}</span>
                            </td>
                            <td><span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-3 py-1 rounded-full">BCA</span>
                            </td>
                        </tr>
                    @empty
                        <div class="w-full h-[100px] flex items-center justify-center">Data order kosong</div>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
