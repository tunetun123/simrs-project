<?php

namespace App\Repositories;

use App\Models\Insurance;
use App\Repositories\Interfaces\InsuranceRepositoryInterface;

class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function all()
    {
        return Insurance::all();
    }

    public function find($id)
    {
        return Insurance::findOrFail($id);
    }

    public function create(array $data)
    {
        return Insurance::create($data);
    }

    public function update($id, array $data)
    {
        $insurance = $this->find($id);
        $insurance->update($data);
        return $insurance;
    }

    public function delete($id)
    {
        $insurance = $this->find($id);
        return $insurance->delete();
    }
}
