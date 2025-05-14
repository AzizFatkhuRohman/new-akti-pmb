<?php

namespace App\Http\Controllers;

use App\Models\SeniorHighSchool;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeniorHighSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'study_id'=>'required|exists:studies,id',
            'name'=>'required|max:200',
            'start'=>'required|year',
            'finish'=>'required|year',
            'province_id'=>'required',
            'city_id'=>'required'
        ]);
        $student_id = Student::where('user_id',Auth::user()->id)->first();
        SeniorHighSchool::create([
            'user_id'=>Auth::user()->id,
            'student_id'=>$student_id,
            'study_id'=>$request->study_id,
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id
        ]);
        return back()->with('success','Data SMK berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'study_id'=>'required|exists:studies,id',
            'name'=>'required|max:200',
            'start'=>'required|year',
            'finish'=>'required|year',
            'province_id'=>'required',
            'city_id'=>'required'
        ]);
        SeniorHighSchool::find($id)->update([
            'study_id'=>$request->study_id,
            'name'=>$request->name,
            'start'=>$request->start,
            'finish'=>$request->finish,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id
        ]);
        return back()->with('success','Data SMK berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SeniorHighSchool::find($id)->delete();
    }
}
