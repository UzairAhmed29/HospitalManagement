<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VendorHospitalRequest;
use App\Http\Requests\HospitalRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Services;
use App\Models\User;
use Session;
use Hash;
use File;

class HospitalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Hospitals";
        $hospitals = Hospital::simplePaginate(20);
        return view('admin.hospitals.view', compact('title', 'hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Hospital";
        $services = Services::all();
        $users = User::where([['role', '=', 'vendor'], ['status', '=', 'Activated']])->get();
        return view('admin.hospitals.add', compact('title', 'services', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalRequest $request)
    {
        $key = uniqid();

        // Brand File Upload configurartion
        $File = $request->file('avatar');
        if ($File) {
            // change filename
            $FileName = time() . '-' . $key . '-' . $File->getClientOriginalName();
            // Move file to uploads directory
            $File->move(public_path('uploads/hospital'), $FileName);
        } else {
            $FileName = null;
        }
        $user = Hospital::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'Deactivated',
            'deaths' => $request->deaths,
            'consultation_fee' => $request->consultation_fee,
            'user_id' => $request->user_id,
            'facilities_services' => implode(",", $request->facilities_services),
            'total_doctors' => $request->total_doctors,
            'active_cases' => $request->active_cases,
            'recovered_patients' => $request->recovered_patients,
            'picture' => $FileName,
        ]);

        Session::flash('success', 'Hospital Created Successfully change the status to Activated to approve');
        return redirect(route('hospital.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $title = "Edit Hospital";
        $services = Services::all();
        $users = User::where([['role', '=', 'vendor'], ['status', '=', 'Activated']])->get();
        return view('admin.hospitals.add', compact('title', 'services', 'users', 'hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalRequest $request, Hospital $hospital)
    {

        $key = uniqid();
        if($request->avatar) {
            $File = $request->file('avatar');
            if ($File) {
                // change filename
                $FileName = time() . '-' . '0' . $key . '-' . $File->getClientOriginalName();
                // Move file to uploads directory
                $File->move(public_path('uploads/hospital'), $FileName);
                $userImage = $hospital->avatar;
                $image_path = public_path().'/uploads/hospital/' . $userImage;
                if(File::exists($image_path)){
                    // Deleting userImage
                  File::delete(public_path('/uploads/hospital/' . $userImage));
            }
        }
        } else {
            // Redirecting if the image is not exist in directory
            $FileName = $hospital->picture;
        }

        $hospital->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $hospital->status,
            'deaths' => $request->deaths,
            'consultation_fee' => $request->consultation_fee,
            'user_id' => $request->user_id,
            'facilities_services' => implode(",", $request->facilities_services),
            'total_doctors' => $request->total_doctors,
            'active_cases' => $request->active_cases,
            'recovered_patients' => $request->recovered_patients,
            'picture' => $FileName,
        ]);
        Session::flash('success', 'Hospital updated successfully');
        return redirect(route('hospital.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        if($hospital) {
            if($hospital->picture) {
                // deleting image
                $image = $hospital->picture;
                // check if the file exist in directory
                $image_path = public_path().'/uploads/hospital/' . $image;
                if(File::exists($image_path)){
                    // Deleting image
                  File::delete(public_path('/uploads/hospital/' . $image));
                }
            }

            $hospital->delete();
            Session::flash('info', 'Hospital deleted successfully!');
            return redirect()->back();
        }
    }

    public function status(Hospital $id)
    {
        $id->update([
            'status' => $id->status == 'Activated' ? 'Deactivated' : 'Activated',
            ]);
        Session::flash('success', 'Status updated successfully!');
        return redirect()->back();
    }

    public function vendor_hospital_view() {
        $title = "My Hospital";
        $services = Services::all();
        $user = auth()->user()->id;
        $hospital = Hospital::where('user_id', $user)->first();
        return view('admin.hospitals.my-hospital', compact('title', 'services', 'hospital'));
    }

    public function vendor_hospital_create(VendorHospitalRequest $request) {
        $key = uniqid();

        // Brand File Upload configurartion
        $File = $request->file('picture');
        if ($File) {
            // change filename
            $FileName = time() . '-' . $key . '-' . $File->getClientOriginalName();
            // Move file to uploads directory
            $File->move(public_path('uploads/hospital'), $FileName);
        } else {
            $FileName = $request->picture;
        }
        $user = Hospital::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'Deactivated',
            'deaths' => $request->deaths,
            'consultation_fee' => $request->consultation_fee,
            'user_id' => $request->user_id,
            'facilities_services' => implode(",", $request->facilities_services),
            'total_doctors' => $request->total_doctors,
            'active_cases' => $request->active_cases,
            'recovered_patients' => $request->recovered_patients,
            'picture' => $FileName,
        ]);

        Session::flash('success', 'Hospital Created Successfully wait till Admin approve your hospital.');
        return redirect(route('vendor_hospital_view'));
    }

    public function vendor_hospital_update(VendorHospitalRequest $request) {
        $user = auth()->user()->id;
        $hospital = Hospital::where('user_id', $user)->first();

        $key = uniqid();
        if($request->file('picture')) {
            $File = $request->file('picture');
            if ($File) {
                // change filename
                $FileName = time() . '-' . '0' . $key . '-' . $File->getClientOriginalName();
                // Move file to uploads directory
                $File->move(public_path('uploads/hospital'), $FileName);
                $userImage = $hospital->picture;
                $image_path = public_path().'/uploads/hospital/' . $userImage;
                if(File::exists($image_path)){
                    // Deleting userImage
                    File::delete(public_path('/uploads/hospital/' . $userImage));
                }
            }
        } else {
            // Redirecting if the image is not exist in directory
            $FileName = $hospital->picture;
        }

        $hospital->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $hospital->status,
            'deaths' => $request->deaths,
            'consultation_fee' => $request->consultation_fee,
            'user_id' => $request->user_id,
            'facilities_services' => implode(",", $request->facilities_services),
            'total_doctors' => $request->total_doctors,
            'active_cases' => $request->active_cases,
            'recovered_patients' => $request->recovered_patients,
            'picture' => $FileName,
        ]);
        Session::flash('success', 'Hospital updated successfully');
        return redirect(route('vendor_hospital_view'));
    }
}
