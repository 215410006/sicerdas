<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function umum()
    {
        return view('pengaturan.umum');
    }

    public function keamanan()
    {
        return view('pengaturan.keamanan');
    }
}

