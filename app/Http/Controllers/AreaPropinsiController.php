<?php

namespace App\Http\Controllers;

use App\Models\AreaPropinsi;
use Illuminate\Http\Request;

class AreaPropinsiController extends Controller
{
    public function index(Request $request)
    {

        $sort = $request->input('sort', 'IdPropinsi');
        //default: IdPropinsi

        $order = $request->input('order', 'asc');
        //default: ascending

        $data = AreaPropinsi::query();

        $data->when(request('id_propinsi'),
        function($query, $keyword) {
            return $query->where('IdPropinsi', 'like', '%' . $keyword . '%');
        });

        $data->when(request('propinsi'),
        function($query, $keyword) {
            return $query->where('Propinsi', 'like', '%' . $keyword . '%');
        });

        $data->when(request('id_negara'),
        function($query, $keyword) {
            return $query->where('IdNegara', 'like', '%' . $keyword . '%');
        });

        $data->when(request('sort_order'),
        function($query, $keyword) {
            return $query->where('SortOrder', 'like', '%' . $keyword . '%');
        });

        $data = $data->orderBy($sort, $order)->paginate(8);
        
        return view('propinsi.index', compact('data', 'sort', 'order'));

}

    public function create()
    {
        return view('propinsi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'IdPropinsi' => 'required|unique:areapropinsi,IdPropinsi',
            'Propinsi' => 'required',
            'IdNegara' => 'required',
            'SortOrder' => 'required'
        ]);

        AreaPropinsi::create([
            'IdPropinsi' => $request->IdPropinsi,
            'Propinsi' => $request->Propinsi,
            'IdNegara' => $request->IdNegara,
            'SortOrder' => $request->SortOrder
        ]);

        return redirect('/propinsi')->with('success', 'Data propinsi berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $propinsi = AreaPropinsi::findOrFail($id);
        return view('propinsi.edit', compact('propinsi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'IdPropinsi' => 'required|unique:areapropinsi,IdPropinsi,' . $id . ',IdPropinsi',
            'Propinsi' => 'required',
            'IdNegara' => 'required',
            'SortOrder' => 'required'
        ]);

        $propinsi = AreaPropinsi::findOrFail($id);
        $propinsi->update([
            'IdPropinsi' => $request->IdPropinsi,
            'Propinsi' => $request->Propinsi,
            'IdNegara' => $request->IdNegara,
            'SortOrder' => $request->SortOrder
        ]);

        return redirect('/propinsi')->with('success', 'Data propinsi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $propinsi = AreaPropinsi::findOrFail($id);
        $propinsi->delete();

        return redirect('/propinsi')->with('success', 'Data propinsi berhasil dihapus!');
    }

    public function loadMore(Request $request)
    {

        $sort = $request->input('sort', 'IdPropinsi');
       

        $order = $request->input('order', 'asc');
        
        $page  = $request->input('page', 2);

        $data = AreaPropinsi::query();

        $data->when(request('id_propinsi'),
        function($query, $keyword) {
            return $query->where('IdPropinsi', 'like', '%' . $keyword . '%');
        });

        $data->when(request('propinsi'),
        function($query, $keyword) {
            return $query->where('Propinsi', 'like', '%' . $keyword . '%');
        });

        $data->when(request('id_negara'),
        function($query, $keyword) {
            return $query->where('IdNegara', 'like', '%' . $keyword . '%');
        });

        $data->when(request('sort_order'),
        function($query, $keyword) {
            return $query->where('SortOrder', 'like', '%' . $keyword . '%');
        });

        $data = $data->orderBy($sort, $order)->paginate(8, ['*'], 'page', $page);
        
        return response()->json([
        'data'     => $data->items(),
        'hasMore'  => $data->hasMorePages(),
        'nextPage' => $data->currentPage() + 1,
    ]);
    }
}