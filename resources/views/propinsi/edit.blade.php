<!DOCTYPE html>
<html>
<head>
    <title>Edit Propinsi</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <h1 class="text-2xl font-bold mb-1">Edit Propinsi</h1>
     <p class="text-sm text-gray-500 mb-4">ubah data propinsi di bawah</p>


    @if ($errors->any())
        <div="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/propinsi/{{ $propinsi->IdPropinsi }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-4 space-y-4">


        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">ID Propinsi:</label><br>
            <input type="number" name="IdPropinsi" value="{{ $propinsi->IdPropinsi }}" required
            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>
            
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Propinsi:</label><br>
             <input type="text" name="Propinsi" value="{{ $propinsi->Propinsi }}" required
            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>
            
        <div>
             <label class="block text-sm font-medium text-gray-700 mb-1">ID Negara:</label><br>
             <input type="number" name="IdNegara" value="{{ $propinsi->IdNegara }}" required
            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div>
             <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order:</label><br>
           <input type="number" name="SortOrder" value="{{ $propinsi->SortOrder }}" required
            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

       <div class="flex gap-2">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            Update</button>
        <a href="/propinsi" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">
            Kembali</a>
        </div>
    </form>
@endsection
</body>
</html>