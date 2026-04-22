<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
    public function all()
    {
        return Position::all();
    }

    public function find($id)
    {
        return Position::findOrFail($id);
    }

    public function create(array $data)
    {
        return Position::create($data);
    }

    public function update($id, array $data)
    {
        $position = $this->find($id);
        $position->update($data);
        return $position;
    }

    public function delete($id)
    {
        $position = $this->find($id);
        return $position->delete();
    }
}
