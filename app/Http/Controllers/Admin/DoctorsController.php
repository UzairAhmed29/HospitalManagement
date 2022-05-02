<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Hospital;
use App\Models\Doctors;
use Session;
use File;


class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Doctors";
        if( auth()->user()->role == 'vendor' ) {
            $user_id = auth()->user()->id;
            $hospital = Hospital::where('user_id', $user_id)->first();
            $doctors = Doctors::where('hospital_id', $hospital->id)->with('hospital')->simplePaginate(20);
        } else {
            $doctors = Doctors::with('hospital')->simplePaginate(20);
        }
        return view('admin.doctors.view', compact('title', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Doctor";
        $services = Services::all();
        if( auth()->user()->role == 'vendor' ) {
            $user_id = auth()->user()->id;
            $hospitals = Hospital::where('user_id', $user_id)->get();
        } else {
            $hospitals = Hospital::where('status', 'Activated')->get();
        }
        return view('admin.doctors.add', compact('title', 'services', 'hospitals'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        $key = uniqid();

        // Brand File Upload configurartion
        $File = $request->file('picture');
        if ($File) {
            // change filename
            $FileName = time() . '-' . $key . '-' . $File->getClientOriginalName();
            // Move file to uploads directory
            $File->move(public_path('uploads/doctor'), $FileName);
        } else {
            $FileName = null;
        }

        $doctor = Doctors::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'hospital_id' => $request->hospital_id,
            'services' => implode(",", $request->services),
            'timming' => $request->timming,
            'bio' => $request->bio,
            'fee' => $request->fee,
            'specialist' => implode(",", $request->specialist),
            'picture' => $FileName,
        ]);

        Session::flash('success', 'Doctor Created Successfully.');
        return redirect(route('doctor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctors  $doctors
     * @return \Illuminate\Http\Response
     */
    public function show(Doctors $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctors  $doctors
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctors $doctor)
    {
        $title = "Edit Doctor";
        $services = Services::all();
        $hospitals = Hospital::where('status', 'Activated')->get();
        return view('admin.doctors.add', compact('title', 'services', 'hospitals', 'doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctors  $doctors
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, Doctors $doctor)
    {
        $key = uniqid();
        if($request->picture) {
            $File = $request->file('picture');
            if ($File) {
                // change filename
                $FileName = time() . '-' . '0' . $key . '-' . $File->getClientOriginalName();
                // Move file to uploads directory
                $File->move(public_path('uploads/doctor'), $FileName);
                $userImage = $doctor->picture;
                $image_path = public_path().'/uploads/doctor/' . $userImage;
                if(File::exists($image_path)){
                    // Deleting userImage
                  File::delete(public_path('/uploads/doctor/' . $userImage));
            }
        }
        } else {
            // Redirecting if the image is not exist in directory
            $FileName = $doctor->picture;
        }

        $doctor->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'hospital_id' => $request->hospital_id,
            'services' => implode(",", $request->services),
            'timming' => $request->timming,
            'bio' => $request->bio,
            'fee' => $request->fee,
            'specialist' => implode(",", $request->specialist),
            'picture' => $FileName,
        ]);

        Session::flash('success', 'Doctor Updated Successfully.');
        return redirect(route('doctor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctors  $doctors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctors $doctor)
    {
        if($doctor->picture) {
            // deleting image
            $image = $doctor->picture;
            // check if the file exist in directory
            $image_path = public_path().'/uploads/doctor/' . $image;
            if(File::exists($image_path)){
                // Deleting image
              File::delete(public_path('/uploads/doctor/' . $image));
            }
        }

        $doctor->delete();
        Session::flash('success', 'Doctor Deleted Successfully.');
        return redirect()->back();
    }
}
