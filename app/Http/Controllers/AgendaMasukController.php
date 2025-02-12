<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaMasukController extends Controller
{
    public function index()
    {
        return view('pages.agendamasuk.index');
    }
}
