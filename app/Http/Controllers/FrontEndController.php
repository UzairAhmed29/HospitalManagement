<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;

class FrontEndController extends Controller {

    public function index() {
        $hospitals = Hospital::all();
        $a = $r = $d = 0;

        foreach( $hospitals as $hospital ) {
            $a += (int) $hospital->active_cases;
            $r += (int) $hospital->recovered_patients;
            $d += (int) $hospital->deaths;
        }
        return view('index', compact('hospitals', 'a', 'r', 'd'));
    }

    public function hospitals() {
        $hospitals = Hospital::where('status', 'Activated')->get();
        return view('hospitals', compact('hospitals'));
    }

    public function hospitalsDetail($slug) {
        
    }
}
