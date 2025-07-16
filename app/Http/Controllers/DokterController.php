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
    $hewan = ChelsiAnimal::with('rekamMedis')->get(); // ambil semua
    return view('dokter.hewan.index', compact('hewan'));
}




public function ubahStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:menunggu,diverifikasi,siap,diadopsi'
    ]);

    $hewan = \App\Models\ChelsiAnimal::findOrFail($id);
    $hewan->status = $request->status;
    $hewan->save();

    return redirect()->route('dokter.hewan.detail', $id)->with('success', 'Status hewan berhasil diperbarui.');
}


    public function hewanDetail($id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);
        $rekamMedis = ChelsiMedicalRecord::where('hewan_id', $id)->latest()->get();

        return view('dokter.hewan.detail', compact('hewan', 'rekamMedis'));
    }

    /*public function tambahRekamMedis(Request $request, $id)
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
}*/

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

public function tambahRekamMedis(Request $request, $id)
{
    $request->validate([
        'tanggal' => 'required|date',
        'kondisi' => 'required|string',
        'vaksinasi' => 'nullable|string',
        'file_hasil' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'layak_adopsi' => 'required|in:1,0',
    ]);

    $filePath = null;
    if ($request->hasFile('file_hasil')) {
        $filePath = $request->file('file_hasil')->store('pemeriksaan', 'public');
    }

    ChelsiMedicalRecord::create([
        'hewan_id' => $id,
        'dokter_id' => Auth::id(),
        'tanggal' => $request->tanggal,
        'kondisi' => $request->kondisi,
        'vaksinasi' => $request->vaksinasi,
        'file_hasil' => $filePath,
        'layak_adopsi' => $request->layak_adopsi,
    ]);

    return redirect()->route('dokter.hewan.detail', $id)->with('success', 'Rekam medis berhasil disimpan!');
}

public function rekapIndex()
{
    // Ambil hanya hewan yang telah diperiksa oleh dokter login
    $rekam = ChelsiMedicalRecord::with('hewan')
        ->where('dokter_id', Auth::id())
        ->latest()
        ->get();

    return view('dokter.rekam.index', compact('rekam'));
}

public function rekapDetail($id)
{
    $rekam = ChelsiMedicalRecord::with('hewan', 'dokter')->findOrFail($id);
    return view('dokter.rekam.detail', compact('rekam'));
}
    
}
