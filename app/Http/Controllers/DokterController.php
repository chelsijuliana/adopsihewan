<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiMedicalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        'tanggal' => 'required|date',
        'kondisi' => 'required|string',
        'vaksinasi' => 'nullable|string',
        'file_hasil' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'layak_adopsi' => 'required|boolean',
    ]);

    $filePath = null;
    if ($request->hasFile('file_hasil')) {
        $filePath = $request->file('file_hasil')->store('hasil_pemeriksaan', 'public');
    }

    ChelsiMedicalRecord::create([
        'hewan_id' => $id,
        'dokter_id' => Auth::user()->id,
        'tanggal' => $request->tanggal,
        'kondisi' => $request->kondisi,
        'vaksinasi' => $request->vaksinasi,
        'file_hasil' => $filePath,
        'layak_adopsi' => $request->layak_adopsi,
    ]);

    return redirect()->route('dokter.hewan.detail', $id)->with('success', 'Rekam medis berhasil ditambahkan.');
}

public function updateRekamMedis(Request $request, $id)
{
    $rekam = ChelsiMedicalRecord::findOrFail($id);

    $request->validate([
        'tanggal' => 'required|date',
        'kondisi' => 'required|string',
        'vaksinasi' => 'nullable|string',
        'file_hasil' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'layak_adopsi' => 'required|boolean',
    ]);

    // Handle upload baru
    $filePath = $rekam->file_hasil;
    if ($request->hasFile('file_hasil')) {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        $filePath = $request->file('file_hasil')->store('hasil_pemeriksaan', 'public');
    }

    $rekam->update([
        'tanggal' => $request->tanggal,
        'kondisi' => $request->kondisi,
        'vaksinasi' => $request->vaksinasi,
        'file_hasil' => $filePath,
        'layak_adopsi' => $request->layak_adopsi,
    ]);

    return redirect()->route('dokter.hewan.detail', $rekam->hewan_id)->with('success', 'Rekam medis berhasil diperbarui.');
}
    
}
