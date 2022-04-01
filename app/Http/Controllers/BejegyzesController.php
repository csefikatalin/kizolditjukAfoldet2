<?php

namespace App\Http\Controllers;

use App\Models\Bejegyzes;

use Illuminate\Http\Request;

class BejegyzesController extends Controller
{
    public function index()
    {

        $bejegyzesek = response()->json(Bejegyzes::with('tevekenyseg')->get());
        return $bejegyzesek;
    }
    public function osztaly($id)
    {

        $bejegyzesek = Bejegyzes::with('tevekenyseg')->where('osztalyokID', $id)->get();
        return $bejegyzesek;
    }
    public function store(Request $request)
    {
        echo $request;
        $bejegyzesek = new Bejegyzes();
        $bejegyzesek->allapot = 0;
        $bejegyzesek->tevekenysegId = $request->tevekenysegId;
        $bejegyzesek->osztalyokID = $request->osztalyokID;

        $bejegyzesek->save();
        return Bejegyzes::find($bejegyzesek->id);
    }
}
