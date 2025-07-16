<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiAdoptionRequest;

class AdopterController extends Controller
{
    public function index()
    {
        return view('adopter.dashboard');
    }

    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with('user')
            ->where('status', 'siap')
            ->where('user_id', '!=', Auth::id())
            ->get();

        // Ambil ID hewan yang sudah diajukan oleh user saat ini
        $hewanSudahDiajukan = ChelsiAdoptionRequest::where('adopter_id', Auth::id())
            ->pluck('hewan_id')
            ->toArray();

        return view('adopter.hewan.index', compact('hewan', 'hewanSudahDiajukan'));
    }

    public function show($id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);

        // Jangan tampilkan hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            abort(403, 'Tidak boleh melihat hewan milik sendiri.');
        }

        return view('adopter.hewan.show', compact('hewan'));
    }

    public function formAjukanAdopsi($id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);

        // Cegah akses langsung ke form adopsi hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            abort(403, 'Tidak bisa mengadopsi hewan milik sendiri.');
        }

        return view('adopter.hewan.form_adopsi', compact('hewan'));
    }

    public function ajukanAdopsi(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string',
            'pengalaman' => 'required|string',
        ]);

        $hewan = ChelsiAnimal::findOrFail($id);

        // Cegah adopsi hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            return back()->with('error', 'Tidak bisa mengadopsi hewan milik sendiri.');
        }

        // Cek apakah user sudah mengajukan sebelumnya
        $cek = ChelsiAdoptionRequest::where('adopter_id', Auth::id())
            ->where('hewan_id', $id)
            ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah mengajukan adopsi untuk hewan ini.');
        }

        ChelsiAdoptionRequest::create([
            'adopter_id' => Auth::id(),
            'hewan_id' => $id,
            'alasan' => $request->alasan,
            'pengalaman' => $request->pengalaman,
            'status' => 'menunggu',
        ]);

        return redirect()->route('adopter.status')->with('success', 'Pengajuan adopsi berhasil dikirim!');
    }

    public function statusAdopsi()
    {
        $permintaan = ChelsiAdoptionRequest::with('hewan')
            ->where('adopter_id', Auth::id())
            ->latest()
            ->get();

        return view('adopter.adopsi.status', compact('permintaan'));
    }

    public function rekamMedis($id)
    {
        $hewan = ChelsiAnimal::with('rekamMedis')->findOrFail($id);
        return view('adopter.hewan.rekam_medis', compact('hewan'));
    }

    public function batalkanAdopsi($id)
    {
        $req = ChelsiAdoptionRequest::where('id', $id)
            ->where('adopter_id', Auth::id())
            ->where('status', 'menunggu')
            ->firstOrFail();

        $req->delete();

        return redirect()->route('adopter.status')->with('success', 'Pengajuan adopsi berhasil dibatalkan.');
}

}
