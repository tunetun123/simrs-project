<?php

namespace App\Repositories\Interfaces;

interface PolyclinicRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    
    // Schedule methods
    public function allSchedules();
    public function createSchedule(array $data);
    public function deleteSchedule($id);
}
