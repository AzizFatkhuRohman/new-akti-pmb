<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('study.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:50|unique:studies,name'
        ]);
        Study::create([
            'name'=>$request->name
        ]);
        return back()->with('success','Jurusan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('study.show',[
            'data'=>Study::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:50|unique:studies,name'
        ]);
        Study::find($id)->update([
            'name'=>$request->name
        ]);
        return back()->with('success','Jurusan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Study::find($id)->delete();
    }
}
