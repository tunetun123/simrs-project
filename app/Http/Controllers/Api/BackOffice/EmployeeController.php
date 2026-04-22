<?php

namespace App\Http\Controllers\Api\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return EmployeeResource::collection($employees);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee($request->validated());
        return new EmployeeResource($employee);
    }

    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeService->updateEmployee($id, $request->validated());
        return new EmployeeResource($employee);
    }

    public function destroy($id)
    {
        $this->employeeService->deleteEmployee($id);
        return response()->json(['message' => 'Employee deleted successfully.']);
    }
}
