<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front-office.admission.index', ['title' => 'Daftar Pendaftaran']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front-office.admission.create', ['title' => 'Buat Pendaftaran']);
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
        return view('front-office.admission.show', ['title' => 'Detail Pendaftaran']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('front-office.admission.edit', ['title' => 'Edit Pendaftaran']);
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
