@extends('layout.account.app')
@section('content')
    <div class="w-full">
        <div class="w-full max-w-7xl px-2 lg:px-8 py-8 mx-auto">
            <table id="search-table">
                <thead>
                    <tr>
                        <th>
                            <span class="flex items-center">
                                Company Name
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Ticker
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Stock Price
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Market Capitalization
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap">Apple Inc.</td>
                        <td>AAPL</td>
                        <td>$192.58</td>
                        <td>$3.04T</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
