<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function all()
    {
        return Department::all();
    }

    public function find($id)
    {
        return Department::findOrFail($id);
    }

    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update($id, array $data)
    {
        $department = $this->find($id);
        $department->update($data);
        return $department;
    }

    public function delete($id)
    {
        $department = $this->find($id);
        return $department->delete();
    }
}
