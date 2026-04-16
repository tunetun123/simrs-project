<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Polyclinic;
use App\Models\Registration;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = Registration::with(['patient', 'polyclinic'])->orderBy('visit_date', 'desc')->get();
        return view('front-office.admission.index', [
            'title' => 'Daftar Pendaftaran',
            'admissions' => $admissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polyclinics = Polyclinic::where('status', 'active')->get();
        $insurances = Insurance::where('status', 'active')->get();

        return view('front-office.admission.create', [
            'title' => 'Buat Pendaftaran',
            'polyclinics' => $polyclinics,
            'insurances' => $insurances
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admission = Registration::with(['patient', 'polyclinic', 'insurance'])->findOrFail($id);
        return view('front-office.admission.show', [
            'title' => 'Detail Pendaftaran',
            'admission' => $admission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admission = Registration::findOrFail($id);
        return view('front-office.admission.edit', [
            'title' => 'Edit Pendaftaran',
            'admission' => $admission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admission = Registration::findOrFail($id);
        $admission->delete();
        return redirect()->route('admissions.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
