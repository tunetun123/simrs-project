<?php

namespace App\Services;

use App\Repositories\Interfaces\PolyclinicRepositoryInterface;

class PolyclinicService
{
    protected $polyclinicRepository;

    public function __construct(PolyclinicRepositoryInterface $polyclinicRepository)
    {
        $this->polyclinicRepository = $polyclinicRepository;
    }

    public function getAllPolyclinics()
    {
        return $this->polyclinicRepository->all();
    }

    public function getPolyclinicById($id)
    {
        return $this->polyclinicRepository->find($id);
    }

    public function createPolyclinic(array $data)
    {
        return $this->polyclinicRepository->create($data);
    }

    public function updatePolyclinic($id, array $data)
    {
        return $this->polyclinicRepository->update($id, $data);
    }

    public function deletePolyclinic($id)
    {
        return $this->polyclinicRepository->delete($id);
    }

    public function getAllSchedules()
    {
        return $this->polyclinicRepository->allSchedules();
    }

    public function createSchedules(array $data)
    {
        $schedulesData = $data['schedules']; 
        $createdSchedules = [];

        foreach ($schedulesData as $item) {
            $scheduleData = [
                'polyclinic_code' => $data['polyclinic_code'],
                'doctor_code' => $data['doctor_code'],
                'insurance_code' => $data['insurance_code'],
                'day' => $item['day'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                'patient_quota' => $item['patient_quota'],
            ];
            $createdSchedules[] = $this->polyclinicRepository->createSchedule($scheduleData);
        }

        return $createdSchedules;
    }

    public function deleteSchedule($id)
    {
        return $this->polyclinicRepository->deleteSchedule($id);
    }
}
