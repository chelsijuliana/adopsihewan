<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use App\Models\ChelsiArticle;

class HomeController extends Controller
{
    public function index()
    {
        $hewan = ChelsiAnimal::where('status', 'siap')
            ->whereDoesntHave('adoptionRequests', function ($q) {
                $q->where('status', 'disetujui');
            })->take(6)->get();

        $artikel = ChelsiArticle::latest()->take(3)->get(); // misal hanya tampil 3 artikel terbaru

        return view('home', compact('hewan', 'artikel'));
    }
}
