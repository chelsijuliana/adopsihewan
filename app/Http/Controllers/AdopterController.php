<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use Illuminate\Support\Facades\Auth;
use App\Models\ChelsiAdoptionRequest;




class AdopterController extends Controller
{
    public function index()
    {
        return view('adopter.dashboard');
    }

    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::where('user_id', '!=', Auth::id())->get();
        return view('adopter.hewan.index', compact('hewan'));
    }

    public function show($id)
    {
        $hewan = \App\Models\ChelsiAnimal::findOrFail($id);

        // Jangan tampilkan hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            abort(403, 'Tidak boleh melihat hewan milik sendiri.');
        }

        return view('adopter.hewan.show', compact('hewan'));
    }

    public function ajukanAdopsi(Request $request, $id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);

        // Cegah adopsi hewan milik sendiri
        if ($hewan->user_id == Auth::id()) {
            return back()->with('error', 'Tidak bisa mengadopsi hewan milik sendiri.');
        }

        // Validasi
        $request->validate([
            'alasan' => 'required|string|min:10',
            'pengalaman' => 'nullable|string',
        ]);

        // Cek apakah sudah mengajukan sebelumnya
        $sudah = ChelsiAdoptionRequest::where('hewan_id', $id)
            ->where('adopter_id', Auth::id())
            ->first();

        if ($sudah) {
            return back()->with('error', 'Kamu sudah mengajukan adopsi untuk hewan ini.');
        }

        // Simpan
        ChelsiAdoptionRequest::create([
            'hewan_id' => $id,
            'adopter_id' => Auth::id(),
            'alasan' => $request->alasan,
            'pengalaman' => $request->pengalaman,
        ]);

        return back()->with('success', 'Permintaan adopsi berhasil dikirim!');
    }

    public function statusAdopsi()
    {
        $permintaan = ChelsiAdoptionRequest::with('hewan')
                        ->where('adopter_id', Auth::id())
                        ->latest()
                        ->get();

        return view('adopter.adopsi.status', compact('permintaan'));
    }


}
