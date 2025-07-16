<?php

namespace App\Http\Controllers;

use App\Models\ChelsiAdoptionRequest;
use Illuminate\Http\Request;
use App\Models\ChelsiAdoptionGallery;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = ChelsiAdoptionGallery::with(['hewan', 'adopter'])->latest()->get();
        return view('galeri.index', compact('galeri'));
    }
    
}
