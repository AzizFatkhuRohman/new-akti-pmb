<?php

namespace App\Http\Controllers;

use App\Models\PassEye;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class PassEyeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pass-eye.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pass-eye.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'R_SPH' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'R_CYL' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'R_AX' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_SPH' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_CYL' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_AX' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf'
        ]);
        if (
            $request->R_SPH < -0.50 || $request->R_SPH > 0.50 ||
            $request->R_CYL < -0.50 || $request->R_CYL > 0.50 ||
            $request->R_AX < -0.50 || $request->R_AX > 0.50 ||
            $request->L_SPH < -0.50 || $request->L_SPH > 0.50 ||
            $request->L_CYL < -0.50 || $request->L_CYL > 0.50 ||
            $request->L_AX < -0.50 || $request->L_AX > 0.50
        ) {
            $status = 'Tidak';
        } else {
            $status = 'Lulus';
        }
        if ($status === 'Tidak') {
            $keterangan = 'Mohon maaf anda tidak lulus cek mata';
        } else {
            $keterangan = 'Selamat anda lulus cek mata';
        }
        $file = $request->file('file');
        $fileName = Str::random(7) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('file_eye', $fileName);
        $student_id = Student::where('user_id', Auth::user()->id)->first();
        PassEye::create([
            'user_id' => Auth::user()->id,
            'student_id' => $student_id,
            'R_SPH' => $request->R_SPH,
            'R_CYL' => $request->R_CYL,
            'R_AX' => $request->R_AX,
            'L_SPH' => $request->L_SPH,
            'L_CYL' => $request->L_CYL,
            'L_AX' => $request->L_AX,
            'status' => $status,
            'keterangan' => $keterangan,
            'file' => $fileName
        ]);
        return back()->with('success', 'Data cek mata berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('pass-eye.show', [
            'data' => PassEye::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'R_SPH' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'R_CYL' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'R_AX' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_SPH' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_CYL' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'L_AX' => ['required', 'regex:/^(?!.*(?:^0\.50$|^-0\.50$)).*$/', 'numeric'],
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf'
        ]);
        if (
            $request->R_SPH < -0.50 || $request->R_SPH > 0.50 ||
            $request->R_CYL < -0.50 || $request->R_CYL > 0.50 ||
            $request->R_AX < -0.50 || $request->R_AX > 0.50 ||
            $request->L_SPH < -0.50 || $request->L_SPH > 0.50 ||
            $request->L_CYL < -0.50 || $request->L_CYL > 0.50 ||
            $request->L_AX < -0.50 || $request->L_AX > 0.50
        ) {
            $status = 'Tidak';
        } else {
            $status = 'Lulus';
        }
        if ($status === 'Tidak') {
            $keterangan = 'Mohon maaf anda tidak lulus cek mata';
        } else {
            $keterangan = 'Selamat anda lulus cek mata';
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = Str::random(7) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('file_eye', $fileName);
        } else {
            $fileName = PassEye::find($id)->value('file');
        }
        PassEye::find($id)->update([
            'R_SPH' => $request->R_SPH,
            'R_CYL' => $request->R_CYL,
            'R_AX' => $request->R_AX,
            'L_SPH' => $request->L_SPH,
            'L_CYL' => $request->L_CYL,
            'L_AX' => $request->L_AX,
            'status' => $status,
            'keterangan' => $keterangan,
            'file' => $fileName
        ]);
        return back()->with('success', 'Data cek mata berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PassEye::find($id)->delele();
    }
}
