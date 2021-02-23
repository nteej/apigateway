<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Traits\ConsumeExternalService;

class VehicleService
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.vehicles.base_uri');
    }

    public function find($id): Vehicle
    {
        return Vehicle::findOrFail($id);
    }

    public function create(array $data): Vehicle
    {
        $vehicle = Vehicle::firstOrCreate($data);
        return $vehicle;
    }

    public function update(Vehicle $vehicle, array $data): Vehicle
    {
        $vehicle->update($data);
        return $vehicle;
    }

    public function obtainVehicles($data)
    {

        return $this->performRequest('GET', $this->baseUri.'/vehicles', $data);
    }
}
