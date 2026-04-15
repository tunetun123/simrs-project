<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front-office.patient.index', ['title' => 'Daftar Pasien']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front-office.patient.create', ['title' => 'Pendaftaran Pasien Baru']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('front-office.patient.show', ['title' => 'Detail Pasien']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('front-office.patient.edit', ['title' => 'Edit Pasien']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
