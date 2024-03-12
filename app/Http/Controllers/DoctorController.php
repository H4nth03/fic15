<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;


class DoctorController extends Controller
{
    //index
    public function index(Request $request)
    {
        $doctors = DB::table('doctors')
        ->when($request->input('name'), function ($query, $doctor_name) {
            return $query->where('doctor_name', 'like', '%' . $doctor_name . '%');
        })
        ->when($request->input('email'), function ($query, $doctor_email) {
            return $query->where('doctor_email', 'like', '%' . $doctor_email . '%');
        })
        ->when($request->input('specialist'), function ($query, $doctor_specialist) {
            return $query->where('doctor_specialist', 'like', '%' . $doctor_specialist . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.doctors.index', compact('doctors'));
    }
    //create
    public function create()
    {
        return view('pages.doctors.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required',
            'doctor_email' => 'required|email|unique:doctors',
            'doctor_phone' => 'required',
            'doctor_specialist' => 'required',
            'photo' => 'nullable',
            'address' => 'nullable',
            'sip' => 'required',
        ]);
       
        DB::table('doctors')->insert([
            'doctor_name' => $request->doctor_name,
            'doctor_email' => $request->doctor_email,
            'doctor_phone' => $request->doctor_phone,
            'doctor_specialist' => $request->doctor_specialist,
            'photo' => $request->photo,
            'address' => $request->address,
            'sip' => $request->sip,
            'created_at' => now(),
            'updated_at' => now(),
        ])
        ;
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully');
    }

    //show
    public function show($id)
    {
        $doctors = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctors.show', compact('doctor'));
    }

    //edit
// DoctorController.php
    public function edit($id)
    {
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctors.edit', compact('doctor'));
    }

    //update
    // DoctorController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name' => 'required',
            'doctor_email' => 'required|email|unique:doctors,doctor_email,' . $id,
            'doctor_phone' => 'required',
            'doctor_specialist' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable',
            'sip' => 'required',
        ]);

        $doctor = Doctor::find($id);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_specialist = $request->doctor_specialist;
        // $doctor->photo = $request->photo;
        $doctor->address = $request->address;
        $doctor->sip = $request->sip;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            // Pindahkan file ke direktori yang ditentukan
            $file->storeAs('public/doc_img', $filename);
            $doctor->photo = $filename;
        }

        $doctor->save();
        // return redirect()->route('users.index')->with('success', 'User updated successfully');

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }


    //destroy
    public function destroy($id)
    {
        DB::table('doctors')->where('id', $id)->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }
}

