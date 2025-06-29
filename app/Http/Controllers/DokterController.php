<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiMedicalRecord;
use Illuminate\Support\Facades\Auth;


class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard');
    }
    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with('user')->get(); // opsional: relasi ke pemberi
        return view('dokter.hewan.index', compact('hewan'));
    }
    public function hewanDetail($id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);
        $rekamMedis = ChelsiMedicalRecord::where('hewan_id', $id)->latest()->get();

        return view('dokter.hewan.detail', compact('hewan', 'rekamMedis'));
    }

    public function tambahRekamMedis(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        ChelsiMedicalRecord::create([
            'hewan_id' => $id,
           'dokter_id' => Auth::id(),
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('dokter.hewan.detail', $id)->with('success', 'Rekam medis berhasil ditambahkan.');
    }
    
}
