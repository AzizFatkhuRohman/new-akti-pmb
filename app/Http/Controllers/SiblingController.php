<?php

namespace App\Http\Controllers;

use App\Models\Sibling;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiblingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sibling.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sibling.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status'=>'required',
            'nama'=>'required|max:200',
            'pendidikan'=>'required',
            'pekerjaan'=>'required'
        ]);
        $student_id = Student::where('user_id',Auth::user()->id)->first();
        Sibling::create([
            'user_id'=>Auth::user()->id,
            'student_id'=>$student_id,
            'status'=>$request->status,
            'nama'=>$request->nama,
            'pendidikan'=>$request->pendidikan,
            'pekerjaan'=>$request->pekerjaan
        ]);
        return back()->with('success','Data saudara berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('sibling.show',[
            'data'=>Sibling::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'=>'required',
            'nama'=>'required|max:200',
            'pendidikan'=>'required',
            'pekerjaan'=>'required'
        ]);
        Sibling::find($id)->update([
            'status'=>$request->status,
            'nama'=>$request->nama,
            'pendidikan'=>$request->pendidikan,
            'pekerjaan'=>$request->pekerjaan
        ]);
        return back()->with('success','Data saudara berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Sibling::find($id)->delete();
    }
}
