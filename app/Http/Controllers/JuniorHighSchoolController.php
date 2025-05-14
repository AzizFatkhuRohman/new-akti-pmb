<?php

namespace App\Http\Controllers;

use App\Models\JuniorHighSchool;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuniorHighSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('junior-high-school.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('junior-high-school.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:100',
            'start'=>'required|year',
            'finish'=>'required|year',
            'province_id'=>'required',
            'city_id'=>'required'
        ]);
        $student_id = Student::where('user_id',Auth::user()->id)->first();
        JuniorHighSchool::create([
            'user_id'=>Auth::user()->id,
            'student'=>$student_id,
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id
        ]);
        return back()->with('success','Data sekolah SMP berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('junior-high-school.show',[
            'data'=>JuniorHighSchool::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:100',
            'start'=>'required|year',
            'finish'=>'required|year',
            'province_id'=>'required',
            'city_id'=>'required'
        ]);
        JuniorHighSchool::find($id)->update([
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id
        ]);
        return back()->with('success','Data sekolah SMP berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        JuniorHighSchool::find($id)->delete();
    }
}
