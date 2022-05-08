<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRegisterRequest;
use App\Http\Controllers\Admin\DoctorsController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Services;
use App\Models\Hospital;
use App\Models\Vaccine;
use App\Models\Doctors;
use App\Models\User;
use Session;
use Hash;
use Auth;

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

    public function doctorsView(Request $request) {
        $services = Services::all();
        $hospitals = Hospital::all();
        $cities = DoctorsController::cities();

        if( $request->has('q') || $request->has('service') || $request->has('hospital') || $request->has('city') ) {

            $doctors = Doctors::where('created_at','>', '1950-01-01 00:00:00');
            if( $request->has('q') ) {
                $doctors->where('name', 'LIKE','%'.$request->q.'%');
            }
            if( $request->has('service') && !empty($request->service) ) {
                $doctors->where('services', 'LIKE','%'.$request->service.'%');
            }
            if( $request->has('hospital') && !empty($request->hospital) ) {
                $doctors->where('hospital_id', $request->hospital);
            }
            if( $request->has('city') && !empty($request->city) ) {
                $doctors->where('city', $request->city);
            }
            if( $request->has('day') && !empty($request->day) ) {
                $doctors->where('working_days', 'LIKE','%'.$request->day.'%');
            }

            $doctors = $doctors->get();

        } else {
            $doctors = Doctors::all();
        }
        return view('doctors.doctors', compact('doctors', 'services', 'hospitals', 'cities'));
    }

    public function doctorsAppointmentView($slug) {
        $doctor = Doctors::with('hospital')->where('slug', $slug)->first();
        $appointments = Appointment::where('doctor_id', $doctor->id)->get();
        $fill_slots = array();

        if( isset($appointments) && count($appointments) > 0 ) {
            foreach( $appointments as $index => $appointment ) {
                $fill_slots[$appointment->app_date] = $appointment->slot;
            }
        }

        $timmings = str_replace(" ", "", $doctor->timming);
        $time_arr = explode("-", $timmings);

        $start_time = $time_arr[0];
        $end_time   = $time_arr[1];

        $s = strtotime($start_time);
        $e = strtotime($end_time);

        // Every 30 Minutes from 8 AM - 5 PM, using Custom Time Format
        $range = $this->hoursRange( $s, $e, 3600, 'h:i a' );

        return view('doctors.doctor-appointment', compact('doctor', 'range', 'fill_slots'));
    }

    public function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
        $times = array();

        if ( empty( $format ) ) {
            $format = 'g:i a';
        }

        foreach ( range( $lower, $upper, $step ) as $increment ) {
            $increment = gmdate( 'H:i', $increment );

            list( $hour, $minutes ) = explode( ':', $increment );

            $date = new \DateTime( $hour . ':' . $minutes );

            $times[(string) $increment] = $date->format( $format );
        }

        return $times;
    }

    public function doctorsAppointmentPost(Request $request) {

        if($request->auth != null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'customer',
                'status' => 'Activated',
                'avatar' => null,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
        } else {
            $user = auth()->user();
        }

        $doctor = Doctors::where('slug', $request->doctor_slug)->first();
        $app = Appointment::create([
            'user_id' => $user->id,
            'doctor_id' => $doctor->id,
            'doctor_name' => $request->doctor_name,
            'hospital_name' => $request->hospital_name,
            'fee' => $request->fee,
            'user_phone' => $request->phone,
            'app_date' => $request->date,
            'app_day' => $request->day,
            'slot' => $request->slot,
            'status' => "On Hold"
        ]);

        Session::flash('success', "true");
        return redirect(route('doctor_app_view', $request->doctor_slug));
    }

}
