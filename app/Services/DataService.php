<?php
namespace App\Services;
use App\Models\Vehicle;

class DataService
{
    public function find($id) : Vehicle
    {
        return Vehicle::findOrFail($id);
    }

    public function create(array $data) : Vehicle
    {
        $vehicle = new Vehicle();
        return $this->update($vehicle, $data);
    }
}
