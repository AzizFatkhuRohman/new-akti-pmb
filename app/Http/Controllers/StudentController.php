<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'entry_route_id'=>'required|exists,entry_routes,id',
            'name'=>'required|max:50',
            'nik'=>'required|digits:16',
            'no_telp'=>'required|numeric',
            'email'=>'required|email|max:50',
            'jenis_kelamin'=>'required',
            'negara'=>'required|max:50',
            'agama'=>'required',
            'status_pernikahan'=>'required',
            'tinggi_badan'=>'required|numeric',
            'berat_badan'=>'required|numeric',
            'golongan_darah'=>'required',
            'tempat_lahir'=>'required|max:100',
            'tanggal_lahir'=>'required|date',
            'province_id'=>'required',
            'city_id'=>'required',
            'district_id'=>'required',
            'village_id'=>'required',
            'alamat'=>'required|max:250',
            'file_student'=>'required|file|mimes:jpg,jpeg,png,pdf|max:3072'
        ]);
        $file = $request->file('file_student');
        $nameFile=Str::random(7).'.'.$file->getClientOriginalExtension();
        $file->storeAs('file_student',$nameFile);
        Student::create([
            'user_id'=>Auth::user()->id,
            'entry_route_id'=>$request->entry_route_id,
            'name'=>$request->name,
            'nik'=>$request->nik,
            'no_telp'=>$request->no_telp,
            'email'=>$request->email,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'negara'=>$request->negara,
            'agama'=>$request->agama,
            'status_pernikahan'=>$request->status_pernikahan,
            'tinggi_badan'=>$request->tinggi_badan,
            'berat_badan'=>$request->berat_badan,
            'golongan_darah'=>$request->golongan_darah,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'district_id'=>$request->district_id,
            'village_id'=>$request->village_id,
            'alamat'=>$request->alamat,
            'file_student'=>$nameFile
        ]);
        return back()->with('success','Data calon mahasiswa berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('student.show',[
            'data'=>Student::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'entry_route_id'=>'required|exists,entry_routes,id',
            'name'=>'required|max:50',
            'nik'=>'required|digits:16',
            'no_telp'=>'required|numeric',
            'email'=>'required|email|max:50',
            'jenis_kelamin'=>'required',
            'negara'=>'required|max:50',
            'agama'=>'required',
            'status_pernikahan'=>'required',
            'tinggi_badan'=>'required|numeric',
            'berat_badan'=>'required|numeric',
            'golongan_darah'=>'required',
            'tempat_lahir'=>'required|max:100',
            'tanggal_lahir'=>'required|date',
            'province_id'=>'required',
            'city_id'=>'required',
            'district_id'=>'required',
            'village_id'=>'required',
            'alamat'=>'required|max:250',
            'file_student'=>'required|file|mimes:jpg,jpeg,png,pdf|max:3072'
        ]);
       if ($request->hasFile('file_student')) {
        $file = $request->file('file_student');
        $nameFile=Str::random(7).'.'.$file->getClientOriginalExtension();
        $file->storeAs('file_student',$nameFile);
       } else {
        $nameFile= Student::find($id)->value('file_student');
       }
       
        Student::find($id)->update([
            'entry_route_id'=>$request->entry_route_id,
            'name'=>$request->name,
            'nik'=>$request->nik,
            'no_telp'=>$request->no_telp,
            'email'=>$request->email,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'negara'=>$request->negara,
            'agama'=>$request->agama,
            'status_pernikahan'=>$request->status_pernikahan,
            'tinggi_badan'=>$request->tinggi_badan,
            'berat_badan'=>$request->berat_badan,
            'golongan_darah'=>$request->golongan_darah,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'district_id'=>$request->district_id,
            'village_id'=>$request->village_id,
            'alamat'=>$request->alamat,
            'file_student'=>$nameFile
        ]);
        return back()->with('success','Data calon mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
    }
}
