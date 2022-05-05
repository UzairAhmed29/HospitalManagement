<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Vaccine;
use App\Models\Hospital;
use App\Models\Doctors;
use App\Models\User;
use Session;
use Hash;

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
        return view('hospitals.hospitals', compact('hospitals'));
    }

    public function vaccines() {
        $vaccines = Vaccine::with('hospital')->get();
        return view('vaccines.vaccines', compact('vaccines'));
    }

    public function hospitalsDetail($slug) {
        $hospital = Hospital::where('slug', $slug)->with('doctors')->first();
        $doctors = Doctors::where('hospital_id', $hospital->id)->get();
        return view('hospitals.hospitals-detail', compact('hospital', 'doctors'));
    }

    public function vendorRegisterView() {
        return view('hospitals.hospital-register');
    }

    public function vendorRegister(VendorRegisterRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'vendor',
            'status' => 'Deactivated',
            'password' => Hash::make($request->password),
        ]);
        Session::flash('success', 'Account created successfully wait till admin approve your account.');
        return redirect(route('vendor_register_view'));
    }

    public function DoctorsDetail($slug) {
        $doctor = Doctors::with('hospital')->where('slug', $slug)->first();
        return view('doctors.detail', compact('doctor'));
    }

    public function vaccine_detail($slug) {
        $vaccine = Vaccine::with('hospital')->where('slug', $slug)->first();
        return view('vaccines.detail', compact('vaccine'));
    }

    public function doctorsView() {
        return view('doctors.doctors');
    }
}
