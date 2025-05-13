<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class FatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('father.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('father.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'status_ayah' => 'required',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required',
            'pekerjaan' => 'required|max:100',
            'penghasilan' => 'required|numeric',
            'status_pernikahan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'alamat' => 'required|max:255',
            'file_ayah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        $student_id = Student::where('user_id', Auth::user()->id)->value('id');
        $file = $request->file('file_ayah');
        $fileName = Str::random(7) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('file_ayah', $fileName);
        Father::create([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'nik' => $request->nik,
            'status_ayah' => $request->status_ayah,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan' => $request->penghasilan,
            'status_pernikahan' => $request->status_pernikahan,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'alamat' => $request->alamat,
            'file_ayah' => $fileName
        ]);
        return back()->with('success', 'Data ayah berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('father.show', [
            'data' => Father::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'status_ayah' => 'required',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required',
            'pekerjaan' => 'required|max:100',
            'penghasilan' => 'required|numeric',
            'status_pernikahan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'alamat' => 'required|max:255',
            'file_ayah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        $student_id = Student::where('user_id', Auth::user()->id)->value('id');
        if ($request->hasFile('file_ayah')) {
            $file = $request->file('file_ayah');
            $fileName = Str::random(7) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_ayah', $fileName);
        } else {
            $fileName = Father::find($id)->value('file_ayah');
        }
        Father::find($id)->update([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'nik' => $request->nik,
            'status_ayah' => $request->status_ayah,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan' => $request->penghasilan,
            'status_pernikahan' => $request->status_pernikahan,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'alamat' => $request->alamat,
            'file_ayah' => $fileName
        ]);
        return back()->with('success', 'Data ayah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Father::find($id)->delete();
    }
}
