<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemberiController extends Controller
{
    public function index()
    {
        return view('pemberi.dashboard');
    }
}
