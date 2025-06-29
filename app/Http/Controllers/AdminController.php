<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChelsiUser;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiAdoptionRequest;
use App\Models\ChelsiMedicalRecord;
use App\Models\ChelsiArticle;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = ChelsiUser::where('role', '!=', 'admin')->get(); // Semua kecuali admin
        return view('admin.users', compact('users'));
    }

    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with('user')->latest()->get();
        return view('admin.hewan.index', compact('hewan'));
    }

    public function adopsiIndex()
    {
        $permintaan = ChelsiAdoptionRequest::with(['hewan', 'adopter'])->latest()->get();
        return view('admin.adopsi.index', compact('permintaan'));
    }

    public function setujuiAdopsi($id)
    {
        $adopsi = ChelsiAdoptionRequest::findOrFail($id);
        $adopsi->status = 'disetujui';
        $adopsi->save();

        return back()->with('success', 'Permintaan adopsi disetujui.');
    }

    public function tolakAdopsi($id)
    {
        $adopsi = ChelsiAdoptionRequest::findOrFail($id);
        $adopsi->status = 'ditolak';
        $adopsi->save();

        return back()->with('success', 'Permintaan adopsi ditolak.');
    }
    public function rekamMedisIndex()
    {
        $rekam = ChelsiMedicalRecord::with(['hewan', 'dokter'])->latest()->get();
        return view('admin.medis.index', compact('rekam'));
    }

    public function artikelIndex()
    {
        $artikel = ChelsiArticle::latest()->get();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    public function artikelStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
        ]);

        ChelsiArticle::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function artikelEdit($id)
    {
        $artikel = ChelsiArticle::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function artikelUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
        ]);

        $artikel = ChelsiArticle::findOrFail($id);
        $artikel->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function artikelDestroy($id)
    {
        $artikel = ChelsiArticle::findOrFail($id);
        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }



    
}
