<?php

namespace App\Http\Transformers;

use App\Models\Vehicle;
use League\Fractal\TransformerAbstract;

class DataTransformer extends TransformerAbstract
{
    public function transform($vehicle)
    {
        return [
            'licence_plate' => $vehicle->identifier,
            'made_by' => $vehicle->make,
            'model' => $vehicle->model,
            'made_in' => $vehicle->year,
        ];
    }
}
