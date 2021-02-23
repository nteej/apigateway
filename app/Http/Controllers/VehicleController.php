<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Transformers\DataTransformer;
use App\Http\Transformers\VehicleTransformer;
use App\Models\Vehicle;
use App\Services\VehicleService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class VehicleController extends Controller
{
    use ApiResponser;
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vehicles = Vehicle::paginate(10);

        return $this->response->paginator($vehicles, new VehicleTransformer());

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVehicleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehicleRequest $request)
    {
        $vehicle = $this->vehicleService->create($request->all());
        return $this->response->item($vehicle, new VehicleTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle,$id)
    {
        $user = $this->vehicleService->find($id);
        return $this->response->item($user, new VehicleTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, $id)
    {
        $vehicle = $this->vehicleService->find($id);
        $vehicle = $this->vehicleService->update($vehicle, $request->all());
        return $this->response->item($vehicle, new VehicleTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function dataServer(): \Dingo\Api\Http\Response
    {
        $csvFileName = env("DATA_FILE", '');
        $csvFilePath = env("DATA_FILE_PATH", base_path());
        $csvFile = public_path($csvFilePath . $csvFileName);
        $dataset = $this->readCSV($csvFile, array('delimiter' => ';'));
        $vehicleObject = new \stdClass();
        $vehicleObject->vehicles=$dataset;
        $paginator = new LengthAwarePaginator(
            $vehicleObject->vehicles, //a fake range of total items, you can use range(1, count($collection))
            count($vehicleObject->vehicles), //count as in 1st parameter
            3, //items per page
            Paginator::resolveCurrentPage(), //resolve the path
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $this->response->paginator($paginator, new DataTransformer());
    }

    private function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        fgetcsv($file_handle);//Omit CSV Header
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        foreach ($line_of_text as $i => $item) {
            $vehicleObject = new \stdClass();
            $vehicleObject->identifier = $item[3];
            $vehicleObject->make = $item[0];
            $vehicleObject->model = $item[1];
            $vehicleObject->year = $item[2];
            $dataset[$i] = $vehicleObject;
        }
        fclose($file_handle);
        return $dataset;
    }

    public function getFromServer(Request $request){
        return $this->successResponse($this->vehicleService->obtainVehicles($request->all()));
    }
}
