<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ChelsiAdoptionRequest;
use App\Models\ChelsiAdoptionGallery;
use App\Models\ChelsiCategory;

class PemberiController extends Controller
{
    public function index()
    {
        return view('pemberi.dashboard');
    }

    // Tampilkan semua hewan milik user pemberi
    public function hewanIndex()
    {
        $hewan = ChelsiAnimal::with(['rekamMedis', 'adoptionRequests'])
                    ->where('user_id', Auth::id())
                    ->get();

        return view('pemberi.hewan.index', compact('hewan'));
    }


    // Form tambah hewan
    public function create()
{
    $kategori = ChelsiCategory::all();
    return view('pemberi.hewan.create', compact('kategori'));
}
    // Simpan hewan baru
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'category_id' => 'required|exists:chelsi_categories,id',
        'ras' => 'nullable|string|max:255',
        'usia' => 'required|integer|min:0',
        'usia_satuan' => 'required|in:bulan,tahun',
        'jenis_kelamin' => 'required|in:jantan,betina',
        'deskripsi' => 'nullable|string',
        'foto' => 'required|image|max:2048',
        'status' => 'required|in:menunggu,diverifikasi,siap,diadopsi',
    ]);

    $kategori = ChelsiCategory::findOrFail($request->category_id);

    $usia = $request->usia_satuan === 'tahun'
        ? $request->usia * 12
        : $request->usia;

    $fotoPath = $request->file('foto')->store('hewan', 'public');

    ChelsiAnimal::create([
        'nama' => $request->nama,
        'jenis' => $kategori->nama, // Ambil dari kategori
        'ras' => $request->ras,
        'usia' => $usia,
        'jenis_kelamin' => $request->jenis_kelamin,
        'deskripsi' => $request->deskripsi,
        'foto' => $fotoPath,
        'user_id' => Auth::id(),
        'status' => $request->status,
        'category_id' => $request->category_id,
    ]);

    return redirect('/pemberi/hewan')->with('success', 'Hewan berhasil ditambahkan.');
}


    // Form edit hewan
   public function edit($id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);
        $kategori = ChelsiCategory::all();
        return view('pemberi.hewan.edit', compact('hewan', 'kategori'));
    }

    // Update data hewan
    public function update(Request $request, $id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'category_id' => 'required|exists:chelsi_categories,id',
            'ras' => 'nullable|string|max:255',
            'usia' => 'required|integer|min:0',
            'usia_satuan' => 'required|in:bulan,tahun',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:menunggu,diverifikasi,siap,diadopsi',
        ]);

        $usia = $request->usia_satuan === 'tahun'
            ? $request->usia * 12
            : $request->usia;

        if ($request->hasFile('foto')) {
            if ($hewan->foto) {
                Storage::disk('public')->delete($hewan->foto);
            }
            $hewan->foto = $request->file('foto')->store('hewan', 'public');
        }

        $kategori = ChelsiCategory::findOrFail($request->category_id);

        $hewan->update([
            'nama' => $request->nama,
            'jenis' => $kategori->nama,
            'category_id' => $request->category_id,
            'ras' => $request->ras,
            'usia' => $usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
            'foto' => $hewan->foto,
            'status' => $request->status,
        ]);

        return redirect('/pemberi/hewan')->with('success', 'Hewan berhasil diperbarui.');
    }

    // Hapus hewan
    public function destroy($id)
    {
        $hewan = ChelsiAnimal::where('user_id', Auth::id())->findOrFail($id);

        try {
            Storage::disk('public')->delete($hewan->foto);
        } catch (\Exception $e) {
            // Aman jika file tidak ditemukan
        }

        $hewan->delete();

        return redirect('/pemberi/hewan')->with('success', 'Hewan berhasil dihapus.');
    }

    // Detail hewan
    public function detailHewan($id)
    {
        $hewan = ChelsiAnimal::findOrFail($id);
        return view('pemberi.hewan.detail', compact('hewan'));
    }

    public function pengajuanAdopsiIndex()
{
    $pengajuan = ChelsiAdoptionRequest::with(['hewan', 'adopter'])
        ->whereHas('hewan', function ($q) {
            $q->where('user_id', Auth::id());
        })
        ->latest()
        ->get();

    return view('pemberi.adopsi.index', compact('pengajuan'));
}

public function setujuiAdopsi($id)
{
    $req = ChelsiAdoptionRequest::findOrFail($id);
    $req->status = 'disetujui';
    $req->save();

    // Ubah status hewan menjadi "diadopsi"
    $hewan = $req->hewan;
    $hewan->status = 'diadopsi';
    $hewan->save();

    // Cek jika belum ada galeri untuk hewan ini
    if (!$hewan->galeri()->exists()) {
        ChelsiAdoptionGallery::create([
            'hewan_id' => $hewan->id,
            'adopter_id' => $req->adopter_id,
            'foto' => $hewan->foto, // pakai foto hewan sebagai default
            'deskripsi' => 'Hewan ini telah berhasil diadopsi dan kini memiliki rumah baru yang penuh kasih. ❤️',
        ]);
    }

    return back()->with('success', 'Pengajuan disetujui dan galeri adopsi ditambahkan.');
}

public function tolakAdopsi($id)
{
    $req = ChelsiAdoptionRequest::findOrFail($id);
    $req->status = 'ditolak';
    $req->save();

    return back()->with('success', 'Pengajuan ditolak.');
}

    
}
