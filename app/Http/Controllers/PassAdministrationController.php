<?php

namespace App\Http\Controllers;

use App\Models\PassAdministration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class PassAdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pass-administration.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
            'keterangan' => 'nullable|max:250'
        ]);
        $student_id = Student::where('user_id', $request->user_id)->first();
        PassAdministration::create([
            'user_id' => $request->user_id,
            'student_id' => $student_id,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
        return back()->with('success', 'Data peserta pmb lolos administrasi berhasil dibuat');
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
            'status' => 'required',
            'keterangan' => 'nullable|max:250'
        ]);
        PassAdministration::find($id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
        return back()->with('success', 'Data peserta pmb lolos administrasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PassAdministration::find($id)->delete();
    }
}
