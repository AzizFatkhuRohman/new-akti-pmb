<?php

namespace App\Http\Controllers;

use App\Models\Raport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('raport.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('raport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai_mtk_1' => 'required|numeric',
            'nilai_indo_1' => 'required|numeric',
            'nilai_inggris_1' => 'required|numeric',
            'nilai_mtk_2' => 'required|numeric',
            'nilai_indo_2' => 'required|numeric',
            'nilai_inggris_2' => 'required|numeric',
            'nilai_mtk_3' => 'required|numeric',
            'nilai_indo_3' => 'required|numeric',
            'nilai_inggris_3' => 'required|numeric',
            'nilai_mtk_4' => 'required|numeric',
            'nilai_indo_4' => 'required|numeric',
            'nilai_inggris_4' => 'required|numeric',
            'nilai_mtk_5' => 'nullable|numeric',
            'nilai_indo_5' => 'nullable|numeric',
            'nilai_inggris_5' => 'nullable|numeric',
            'file' => 'required|file|mimes:pdf|max:3072'
        ]);
        $file = $request->file('file');
        $nameFile = Str::random(7) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('file_raport', $nameFile);
        $student_id = Student::where('user_id', Auth::user()->id)->first();
        Raport::create([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'nilai_mtk_1' => $request->nilai_mtk_1,
            'nilai_indo_1' => $request->nilai_indo_1,
            'nilai_inggris_1' => $request->nilai_inggris_1,
            'nilai_mtk_2' => $request->nilai_mtk_2,
            'nilai_indo_2' => $request->nilai_indo_2,
            'nilai_inggris_2' => $request->nilai_inggris_2,
            'nilai_mtk_3' => $request->nilai_mtk_3,
            'nilai_indo_3' => $request->nilai_indo_3,
            'nilai_inggris_3' => $request->nilai_inggris_3,
            'nilai_mtk_4' => $request->nilai_mtk_4,
            'nilai_indo_4' => $request->nilai_indo_4,
            'nilai_inggris_4' => $request->nilai_inggris_4,
            'nilai_mtk_5' => $request->nilai_mtk_5,
            'nilai_indo_5' => $request->nilai_indo_5,
            'nilai_inggris_5' => $request->nilai_inggris_5,
            'file' => $nameFile
        ]);
        return back()->with('success', 'Data raport berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('raport.show', ['data' => Raport::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_mtk_1' => 'required|numeric',
            'nilai_indo_1' => 'required|numeric',
            'nilai_inggris_1' => 'required|numeric',
            'nilai_mtk_2' => 'required|numeric',
            'nilai_indo_2' => 'required|numeric',
            'nilai_inggris_2' => 'required|numeric',
            'nilai_mtk_3' => 'required|numeric',
            'nilai_indo_3' => 'required|numeric',
            'nilai_inggris_3' => 'required|numeric',
            'nilai_mtk_4' => 'required|numeric',
            'nilai_indo_4' => 'required|numeric',
            'nilai_inggris_4' => 'required|numeric',
            'nilai_mtk_5' => 'nullable|numeric',
            'nilai_indo_5' => 'nullable|numeric',
            'nilai_inggris_5' => 'nullable|numeric',
            'file' => 'required|file|mimes:pdf|max:3072'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nameFile = Str::random(7) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_raport', $nameFile);
        } else {
            $nameFile = Raport::find($id)->value('file');
        }
        Raport::find($id)->update([
            'nilai_mtk_1' => $request->nilai_mtk_1,
            'nilai_indo_1' => $request->nilai_indo_1,
            'nilai_inggris_1' => $request->nilai_inggris_1,
            'nilai_mtk_2' => $request->nilai_mtk_2,
            'nilai_indo_2' => $request->nilai_indo_2,
            'nilai_inggris_2' => $request->nilai_inggris_2,
            'nilai_mtk_3' => $request->nilai_mtk_3,
            'nilai_indo_3' => $request->nilai_indo_3,
            'nilai_inggris_3' => $request->nilai_inggris_3,
            'nilai_mtk_4' => $request->nilai_mtk_4,
            'nilai_indo_4' => $request->nilai_indo_4,
            'nilai_inggris_4' => $request->nilai_inggris_4,
            'nilai_mtk_5' => $request->nilai_mtk_5,
            'nilai_indo_5' => $request->nilai_indo_5,
            'nilai_inggris_5' => $request->nilai_inggris_5,
            'file' => $nameFile
        ]);
        return back()->with('success', 'Data raport berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Raport::find($id)->delete();
    }
}
