<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChelsiAnimal;
use Illuminate\Support\Facades\Auth;

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
}
