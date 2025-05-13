<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('achievement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'tingkat' => 'required',
            'name' => 'required|max:200',
            'penyelenggara' => 'required|max:200',
            'file_sertifikat' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048'
        ]);
        $student_id = Student::where('user_id', Auth::user()->id)->value('id');
        $file = $request->file('file_sertifikat');
        $fileName = Str::random(10) . '.' . $file->getOriginalName();
        $file->storeAs('achievement', $fileName);
        Achievement::create([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'name' => $request->name,
            'penyelenggara' => $request->penyelenggara,
            'file_sertifikat' => $fileName
        ]);
        return back()->with('success', 'Prestasi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('achievement.show', [
            'data' => Achievement::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required',
            'tingkat' => 'required',
            'name' => 'required|max:200',
            'penyelenggara' => 'required|max:200',
            'file_sertifikat' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048'
        ]);
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $fileName = Str::random(10) . '.' . $file->getOriginalName();
            $file->storeAs('achievement', $fileName);
        } else {
            $fileName = Achievement::find($id)->value('file_sertifikat');
        }

        Achievement::find($id)->update([
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'name' => $request->name,
            'penyelenggara' => $request->penyelenggara,
            'file_sertifikat' => $fileName
        ]);
        return back()->with('success', 'Prestasi berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Achievement::find($id)->delete();
    }
}
