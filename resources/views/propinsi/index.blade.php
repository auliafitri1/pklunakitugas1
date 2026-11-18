@extends('layouts.app')

@section('title' , 'Daftar Propinsi')
@section('page-title', 'Daftar Propinsi')
@section('page-subtitle', 'kelola data propinsi disini')

@section('content')

<div class="flex justify-between items-center mb-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Propinsi</h1>
        <p class="text-sm text-gray-500">Kelola data propinsi disini</p>
    </div>


    <div class="flex gap-2">
    <button type="button" id="toggle-search-btn" class="bg-gray-100
     hover:bg-gray-200 text-gray-700 font-medium px-4 py-2 rounded-lg shadow-sm transition">pencarian</button>

    <a href="/propinsi/create" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">
        + Tambah Propinsi</a>
</div>
</div>

@if(session('success'))
<div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-4 text-sm">
     {{ session('success') }}
</div>
@endif

<div id="search-container" style="display: none;" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-5">
<form action="/propinsi" method="GET">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <input type="text" name="id_propinsi" placeholder="Cari ID..." value="{{ request('id_propinsi') }}"
               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

        <input type="text" name="propinsi" placeholder="Cari Nama..." value="{{ request('propinsi') }}"
               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

        <input type="text" name="id_negara" placeholder="Cari ID Negara..." value="{{ request('id_negara') }}"
               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

        <input type="text" name="sort_order" placeholder="Cari Sort Order..." value="{{ request('sort_order') }}"
               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
    </div>
    <div class="mt-4 flex gap-2">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Filter</button>
        <a href="/propinsi" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">Reset</a>
    </div>
</form>
</div>

@php
    $sortUrl = fn($col) => request()->fullUrlWithQuery([
        'sort' => $col,
        'order' => request('sort') == $col && request('order') == 'asc' ? 'desc' : 'asc'
    ]);
    $sortIcon = fn($col) => request('sort') == $col ? (request('order') == 'asc' ? ' (naik)' : ' (turun)') : '';
@endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="max-h-[350px] overflow-y-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left border-b border-gray-100 sticky top-0 z-10">
            <tr>
                <th class="px-5 py-3 font-medium">
                    <a href="{{ $sortUrl('IdPropinsi') }}" class="hover:text-blue-600 flex items-center gap-1">ID Propinsi{{ $sortIcon('IdPropinsi') }}</a>
                </th>
                <th class="px-5 py-3 font-medium">
                    <a href="{{ $sortUrl('Propinsi') }}" class="hover:text-blue-600 flex items-center gap-1">Nama Propinsi{{ $sortIcon('Propinsi') }}</a>
                </th>
                <th class="px-5 py-3 font-medium">
                    <a href="{{ $sortUrl('IdNegara') }}" class="hover:text-blue-600 flex items-center gap-1">ID Negara{{ $sortIcon('IdNegara') }}</a>
                </th>
                <th class="px-5 py-3 font-medium">
                    <a href="{{ $sortUrl('SortOrder') }}" class="hover:text-blue-600 flex items-center gap-1">Sort Order{{ $sortIcon('SortOrder') }}</a>
                </th>
                <th class="px-5 py-3 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body" 
        class="divide-y divide-gray-100"
        data-load-more-url="/propinsi/load-more">
            @foreach($data as $item)
            <tr class="odd:bg-white even:bg-blue-50 hover:bg-blue-100 transition">
                <td class="px-5 py-3 text-gray-600">{{ $item->IdPropinsi }}</td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $item->Propinsi }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $item->IdNegara }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $item->SortOrder }}</td>
                <td class="px-5 py-3 text-right space-x-2">
                    <a href="/propinsi/{{ $item->IdPropinsi }}/edit" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                    <form action="/propinsi/{{ $item->IdPropinsi }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="loading-indicator" style="display:none;" class="text-center py-4">
        <span class="inline-block w-6 h-6 border-2 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></span>
    </div>
    <div id="end-of-data" style="display:none;" class="text-center py-4 text-sm text-gray-400">semua data sudah di tampilkan</div>
</div>
</div>


<p class="text-sm text-gray-500 mt-3">
   Menampilkan <span id="data-count">{{ $data->count() }}</span> data dari {{ $data->total() }} total data
</p>



@endsection

@push('scripts')
<script>
    window.renderLazyRow = function (item) {
        return `
             <tr class="odd:bg-white even:bg-blue-50 hover:bg-blue-100 transition">
                <td class="px-5 py-3 text-gray-600">{{ $item->IdPropinsi }}</td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $item->Propinsi }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $item->IdNegara }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $item->SortOrder }}</td>
                <td class="px-5 py-3 text-right space-x-2">
                    <a href="/propinsi/{{ $item->IdPropinsi }}/edit" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                    <form action="/propinsi/{{ $item->IdPropinsi }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        `;
    };
</script>
@endpush