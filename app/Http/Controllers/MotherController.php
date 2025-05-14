<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class MotherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mother.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mother.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'status_ibu' => 'required',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required',
            'pekerjaan' => 'required|max:50',
            'penghasilan' => 'required|numeric',
            'status_pernikahan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'alamat' => 'required|max:200',
            'file_ibu' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);
        $file = $request->file('file_ibu');
        $nameFile = Str::random(7) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('file_ibu', $nameFile);
        $student_id = Student::where('user_id', Auth::user()->id)->first();
        Mother::create([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'nik' => $request->nik,
            'status_ibu' => $request->status_ibu,
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
            'file_ibu' => $nameFile
        ]);
        return back()->with('success', 'Data ibu berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('mother.show', [
            'data' => Mother::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'status_ibu' => 'required',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required',
            'pekerjaan' => 'required|max:50',
            'penghasilan' => 'required|numeric',
            'status_pernikahan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'alamat' => 'required|max:200',
            'file_ibu' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);
        if ($request->hasFile('file_ibu')) {
            $file = $request->file('file_ibu');
            $nameFile = Str::random(7) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_ibu', $nameFile);
        } else {
            $nameFile = Mother::find($id)->value('file_ibu');
        }
        Mother::find($id)->update([
            'nik' => $request->nik,
            'status_ibu' => $request->status_ibu,
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
            'file_ibu' => $nameFile
        ]);
        return back()->with('success', 'Data ibu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Mother::find($id)->delete();
    }
}
