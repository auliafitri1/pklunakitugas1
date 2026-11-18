<?php

namespace App\Http\Controllers;

use App\Models\AreaKabKota;
use Illuminate\Http\Request;

class AreaKabKotaController extends Controller
{
    public function index(Request $request)
    {

        $sort = $request->input('sort', 'IdKabkota');
        //default: IdPropinsi

        $order = $request->input('order', 'asc');
        //default: ascending

        $data = AreaKabKota::query();

        $data->when(request('id_kabkota'),
        function($query, $keyword) {
            return $query->where('IdKabKota', 'like', '%' . $keyword . '%');
        });

        $data->when(request('kabupatenkota'),
        function($query, $keyword) {
            return $query->where('KabupatenKota', 'like', '%' . $keyword . '%');
        });

        $data->when(request('id_propinsi'),
        function($query, $keyword) {
            return $query->where('IdPropinsi', 'like', '%' . $keyword . '%');
        });

        $data = $data->orderBy($sort, $order)->paginate(8);
        
        return view('kabkota.index', compact('data', 'sort', 'order'));

}

    public function create()
    {
        return view('kabkota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'IdKabKota' => 'required|unique:areakabkota,IdKabKota',
            'KabupatenKota' => 'required',
            'IdPropinsi' => 'required',
           
        ]);

        AreaKabKota::create([
            'IdKabKota' => $request->IdKabKota,
            'KabupatenKota' => $request->KabupatenKota,
            'IdPropinsi' => $request->IdPropinsi,
        
        ]);

        return redirect('/kabkota')->with('success', 'Data propinsi berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $kabkota = AreaKabKota::findOrFail($id);
        return view('kabkota.edit', compact('kabkota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'IdKabKota' => 'required|unique:areakabkota,IdKabKota,' . $id . ',IdKabKota',
            'KabupatenKota' => 'required',
            'IdPropinsi' => 'required',
        
        ]);

        $kabkota = AreaKabKota::findOrFail($id);
        $kabkota->update([
            'IdKabKota' => $request->IdKabKota,
            'KabupatenKota' => $request->KabupatenKota,
            'IdPropinsi' => $request->IdPropinsi,
        
        ]);

        return redirect('/kabkota')->with('success', 'Data propinsi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kabkota = AreaKabkota::findOrFail($id);
        $kabkota->delete();

        return redirect('/kabkota')->with('success', 'Data propinsi berhasil dihapus!');
    }

     public function loadMore(Request $request)
    {
         $sort = $request->input('sort', 'IdKabkota');
        //default: IdPropinsi

        $order = $request->input('order', 'asc');
        //default: ascending

        $page  = $request->input('page', 2);

        $data = AreaKabKota::query();

        $data->when(request('id_kabkota'),
        function($query, $keyword) {
            return $query->where('IdKabKota', 'like', '%' . $keyword . '%');
        });

        $data->when(request('kabupatenkota'),
        function($query, $keyword) {
            return $query->where('KabupatenKota', 'like', '%' . $keyword . '%');
        });

        $data->when(request('id_propinsi'),
        function($query, $keyword) {
            return $query->where('IdPropinsi', 'like', '%' . $keyword . '%');
        });

        $data = $data->orderBy($sort, $order)->paginate(8, ['*'], 'page', $page);
        
        return response()->json([
        'data'     => $data->items(),
        'hasMore'  => $data->hasMorePages(),
        'nextPage' => $data->currentPage() + 1,
    ]);
    }
}