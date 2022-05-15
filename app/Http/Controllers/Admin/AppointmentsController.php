<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Session;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "All Appointments";
        if( auth()->user()->role != 'admin' ) {
            $appointments = Appointment::with('user', 'doctor')->where('user_id', auth()->user()->id)->simplePaginate(20);
        } else {
            $appointments = Appointment::with('user', 'doctor')->simplePaginate(20);
        }
        return view('admin.appointments.view', compact('title', 'appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($appointment)
    {
        $appointment = Appointment::with('user', 'doctor')->where('id', $appointment)->first();
        return view('admin.appointments.detail', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        Session::flash('success', 'Appointment deleted successfully!');
        return redirect()->back();
    }

    public function appStatusUpdate(Appointment $appointment, Request $request)
    {
        $appointment->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }
}
