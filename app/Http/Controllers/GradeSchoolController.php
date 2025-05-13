<?php

namespace App\Http\Controllers;

use App\Models\GradeSchool;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('grade_school.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grade_school.create');
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
            'province_id' => 'required',
            'city_id' => 'required'
        ]);
        $student_id = Student::where('user_id',Auth::user()->id)->value('id');
        GradeSchool::create([
            'user_id'=>Auth::user()->id,
            'student_id'=>$student_id,
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id
        ]);
        return back()->with('success','Data SD berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('grade_school.show');
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
            'province_id' => 'required',
            'city_id' => 'required'
        ]);
        GradeSchool::create([
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id
        ]);
        return back()->with('success','Data SD berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        GradeSchool::find($id)->delete();
    }
}
