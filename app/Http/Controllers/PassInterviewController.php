<?php

namespace App\Http\Controllers;

use App\Models\PassInterview;
use App\Models\Student;
use Illuminate\Http\Request;

class PassInterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pass-interview.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pass-interview.create');
    }

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
        PassInterview::create([
            'user_id' => $request->user_id,
            'student_id' => $student_id,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
        return back()->with('success', 'Data peserta pmb lolos interview berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('pass-interview.show', [
            'data' => PassInterview::find($id)
        ]);
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
        PassInterview::find($id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
        return back()->with('success', 'Data peserta pmb lolos interview berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PassInterview::find($id)->delete();
    }
}
