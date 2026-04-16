<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Insurance;
use App\Services\PolyclinicService;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    protected $polyclinicService;

    public function __construct(PolyclinicService $polyclinicService)
    {
        $this->polyclinicService = $polyclinicService;
    }

    public function index()
    {
        $schedules = $this->polyclinicService->getAllSchedules();
        $polyclinics = $this->polyclinicService->getAllPolyclinics();
        
        return view('front-office.polyclinic.index', [
            'title' => 'Manajemen Poliklinik',
            'schedules' => $schedules,
            'polyclinics' => $polyclinics
        ]);
    }

    public function create()
    {
        $polyclinics = $this->polyclinicService->getAllPolyclinics();
        $doctors = Employee::whereHas('doctor')->get();
        $insurances = Insurance::where('status', 'active')->get();

        return view('front-office.polyclinic.create', [
            'title' => 'Buat Jadwal Poliklinik',
            'polyclinics' => $polyclinics,
            'doctors' => $doctors,
            'insurances' => $insurances
        ]);
    }

    public function show(string $id)
    {
        // For schedule detail if needed, but for now we focus on index/create
        return redirect()->route('polyclinics.index');
    }

    public function edit(string $id)
    {
        // Edit schedule logic...
        return redirect()->route('polyclinics.index');
    }

    public function destroy(string $id)
    {
        $this->polyclinicService->deleteSchedule($id);
        return redirect()->route('polyclinics.index')->with('success', 'Jadwal poliklinik berhasil dihapus.');
    }
}
