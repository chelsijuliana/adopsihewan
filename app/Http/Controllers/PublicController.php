<?php

namespace App\Http\Controllers;

use App\Models\ChelsiArticle;

class PublicController extends Controller
{
    public function listArtikel()
    {
        $artikel = ChelsiArticle::latest()->paginate(6); // bisa diubah ke all() jika tanpa pagination
        return view('public.artikel.index', compact('artikel'));
    }

    public function detailArtikel($id)
    {
        $a = ChelsiArticle::findOrFail($id);
        return view('public.artikel.show', compact('a'));
    }
}
