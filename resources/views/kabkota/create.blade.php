<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kabupaten/Kota</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <h1 class="text-2xl font-bold mb-1">Tambah Kabupaten/Kota</h1>
    <p class="text-sm text-gray-500 mb-4">Isi form di bawah untuk menambahkan data</p>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/kabkota" method="POST" class="max-w-2xl">
        @csrf

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-4 space-y-4">

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ID KabKota</label>
                <input type="number" name="IdKabKota" required
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

           
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kabupaten/Kota</label>
                <input type="text" name="KabupatenKota" required
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ID Propinsi</label>
                <input type="number" name="IdPropinsi" value="1" required
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

        </div>

       
        <div class="flex gap-2">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                Simpan
            </button>
            <a href="/kabkota"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">
                Kembali
            </a>
        </div>
    </form>

    @endsection
</body>
</html>