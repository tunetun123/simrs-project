<?php

namespace App\Repositories;

use App\Models\Nurse;
use App\Repositories\Interfaces\NurseRepositoryInterface;

class NurseRepository implements NurseRepositoryInterface
{
    public function all()
    {
        return Nurse::with('employee')->get();
    }

    public function find($id)
    {
        return Nurse::with('employee')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Nurse::create($data);
    }

    public function update($id, array $data)
    {
        $nurse = $this->find($id);
        $nurse->update($data);
        return $nurse;
    }

    public function delete($id)
    {
        $nurse = $this->find($id);
        return $nurse->delete();
    }
}
