<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Users";
        $users = User::simplePaginate(20);
        return view('admin.users.view', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New User";
        return view('admin.users.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $key = uniqid();

        // Brand File Upload configurartion
        $File = $request->file('avatar');
        if ($File) {
            // change filename
            $FileName = time() . '-' . $key . '-' . $File->getClientOriginalName();
            // Move file to uploads directory
            $File->move(public_path('uploads/user'), $FileName);
        } else {
            $FileName = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => 'Deactivated',
            'avatar' => $FileName,
            'password' => Hash::make($request->password),
        ]);

        Session::flash('success', 'User Created Successfully please change the status to Activated to approve the user');
        return redirect(route('user.index'));
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
    public function edit(User $user)
    {
        $title = "Edit User";
        return view('admin.users.add', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if(empty($request->password)) {
            $password = $user->password;
        } else {
            $password = Hash::make($request->password);
        }
        $key = uniqid();
        if($request->avatar) {
            $File = $request->file('avatar');
            if ($File) {
                // change filename
                $FileName = time() . '-' . '0' . $key . '-' . $File->getClientOriginalName();
                // Move file to uploads directory
                $File->move(public_path('uploads/user'), $FileName);
                $userImage = $user->avatar;
                $image_path = public_path().'/uploads/user/' . $userImage;
                if(File::exists($image_path)){
                    // Deleting userImage
                  File::delete(public_path('/uploads/user/' . $userImage));
            }
        }
        } else {
            // Redirecting if the image is not exist in directory
            $FileName = $user->avatar;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $FileName,
            'password' => $password,
        ]);
        Session::flash('success', 'User updated successfully');
        if( $request->redirect_to_vendor == 'true') {
            return redirect(route('vendor_profile_view'));
        }
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user) {
            if($user->avatar) {
                // deleting image
                $image = $user->avatar;
                // check if the file exist in directory
                $image_path = public_path().'/uploads/user/' . $image;
                if(File::exists($image_path)){
                    // Deleting image
                  File::delete(public_path('/uploads/user/' . $image));
                }
            }

            $user->delete();
            Session::flash('info', 'User deleted successfully!');
            return redirect()->back();
        }
    }

    public function status(User $id)
    {
        $id->update([
            'status' => $id->status == 'Activated' ? 'Deactivated' : 'Activated',
            ]);
        Session::flash('success', 'Status updated successfully!');
        return redirect()->back();
    }

    public function vendorProfile() {
        $title = "Profile";
        $user = auth()->user();
        return view('admin.users.vendor-profile', compact('title', 'user'));
    }
}
