<?php

namespace App\Http\Controllers;

use App\Models\EntryRoute;
use Illuminate\Http\Request;

class EntryRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('entry_route.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entry_route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'tahun_pmb' => 'required|year'
        ]);
        EntryRoute::create([
            'name' => $request->name,
            'tahun_pmb' => $request->tahun_pmb
        ]);
        return back()->with('success', 'Jalur masuk berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('entry_route.show', [
            'data' => EntryRoute::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'tahun_pmb' => 'required|year'
        ]);
        EntryRoute::find($id)->update([
            'name' => $request->name,
            'tahun_pmb' => $request->tahun_pmb
        ]);
        return back()->with('success', 'Jalur masuk berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EntryRoute::find($id)->delete();
    }
}
