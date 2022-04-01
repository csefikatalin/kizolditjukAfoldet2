<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tevekenyseg;

class TevekenysegController extends Controller
{
    //
    public function index()
    {
        // $tasks = response()->json(Task::all());
        $tevekenysegek = response()->json(Tevekenyseg::all());
        return $tevekenysegek;
    }

}
