<?php

namespace App\Http\Controllers\Api\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Http\Resources\InsuranceResource;
use App\Services\InsuranceService;

use Illuminate\Support\Facades\Storage;

class InsuranceController extends Controller
{
    protected $insuranceService;

    public function __construct(InsuranceService $insuranceService)
    {
        $this->insuranceService = $insuranceService;
    }

    public function index()
    {
        $insurances = $this->insuranceService->getAllInsurances();
        return InsuranceResource::collection($insurances);
    }

    public function store(StoreInsuranceRequest $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('insurances', 'public');
            $validated['logo'] = $path;
        }

        $insurance = $this->insuranceService->createInsurance($validated);
        return new InsuranceResource($insurance);
    }

    public function show($id)
    {
        $insurance = $this->insuranceService->getInsuranceById($id);
        return new InsuranceResource($insurance);
    }

    public function update(UpdateInsuranceRequest $request, $id)
    {
        $validated = $request->validated();
        $insurance = $this->insuranceService->getInsuranceById($id);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($insurance->logo) {
                Storage::disk('public')->delete($insurance->logo);
            }
            $path = $request->file('logo')->store('insurances', 'public');
            $validated['logo'] = $path;
        }

        $insurance = $this->insuranceService->updateInsurance($id, $validated);
        return new InsuranceResource($insurance);
    }

    public function destroy($id)
    {
        $this->insuranceService->deleteInsurance($id);
        return response()->json(['message' => 'Insurance deleted successfully.']);
    }
}
