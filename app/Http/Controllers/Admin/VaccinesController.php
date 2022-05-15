<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VaccineRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Vaccine;
use Session;
use File;

class VaccinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = "Vaccines";
        if( auth()->user()->role == 'vendor' ) {
            $user_id = auth()->user()->id;
            $hospital = Hospital::where('user_id', $user_id)->first();
            $vaccines = Vaccine::where('hospital_id', @$hospital->id)->with('hospital')->simplePaginate(20);
        } else {
            $vaccines = Vaccine::with('hospital')->simplePaginate(20);
        }
        return view('admin.vaccines.view', compact('title', 'vaccines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Vaccine";
        if( auth()->user()->role == 'vendor' ) {
            $user_id = auth()->user()->id;
            $hospitals = Hospital::where('user_id', $user_id)->get();
        } else {
            $hospitals = Hospital::where('status', 'Activated')->get();
        }
        return view('admin.vaccines.add', compact('title', 'hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VaccineRequest $request)
    {
        $key = uniqid();

        // Brand File Upload configurartion
        $File = $request->file('picture');
        if ($File) {
            // change filename
            $FileName = time() . '-' . $key . '-' . $File->getClientOriginalName();
            // Move file to uploads directory
            $File->move(public_path('uploads/vaccine'), $FileName);
        } else {
            $FileName = null;
        }

        $user = Vaccine::create([
            'name' => $request->name,
            'hospital_id' => $request->hospital_id,
            'slug' => str_slug($request->name),
            'price' => $request->price,
            'doses' => $request->doses,
            'effective' => $request->effective,
            'doses' => $request->effective,
            'picture' => $FileName,
        ]);

        Session::flash('success', 'Vaccine Created Successfully.');
        return redirect(route('vaccine.index'));
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
    public function edit(Vaccine $vaccine)
    {
        $title = 'Edit Vaccine';
        $hospitals = Hospital::where('status', 'Activated')->get();
        return view('admin.vaccines.add', compact('title', 'hospitals', 'vaccine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VaccineRequest $request, Vaccine $vaccine)
    {
        $key = uniqid();
        if($request->file('picture')) {
            $File = $request->file('picture');
            if ($File) {
                // change filename
                $FileName = time() . '-' . '0' . $key . '-' . $File->getClientOriginalName();
                // Move file to uploads directory
                $File->move(public_path('uploads/vaccine'), $FileName);
                $userImage = $vaccine->avatar;
                $image_path = public_path().'/uploads/vaccine/' . $userImage;
                if(File::exists($image_path)){
                    // Deleting userImage
                  File::delete(public_path('/uploads/vaccine/' . $userImage));
            }
        }
        } else {
            // Redirecting if the image is not exist in directory
            $FileName = $vaccine->avatar;
        }

        $vaccine->update([
            'name' => $request->name,
            'hospital_id' => $request->hospital_id,
            'slug' => str_slug($request->name),
            'price' => $request->price,
            'doses' => $request->doses,
            'effective' => $request->effective,
            'doses' => $request->effective,
            'picture' => $FileName,
        ]);
        Session::flash('success', 'Vaccine updated successfully');
        return redirect(route('vaccine.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();

        Session::flash('success', 'Vaccine Deleted Successfully.');
        return redirect()->back();
    }
}
