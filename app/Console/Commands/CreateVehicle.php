<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class CreateVehicle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:vehicle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a vehicle and save to the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Vehicle $vehicle
     * @return int
     */
    public function handle()
    {
        do {
            $details = $this->setVehicleData($details ?? null);
            $identifier = $details['identifier'];
            $make = $details['make'];
            $model = $details['model'];
            $made_in = $details['made_in'];
        } while (!$this->confirm("Will create new vehicle with <{$identifier}> model of <{$model}> made by <{$make}> in <{$made_in}>.Do you wish to continue?", true));
        $vehicle = Vehicle::firstOrCreate([
            'identifier' => $identifier,
            'make' => $make,
            'model' => $model,
            'year' => $made_in
        ]);
        $this->info("Created new vehicle #{$vehicle->id}");

    }

    protected function setVehicleData($defaults = null)
    {
        $identifier = $this->ask('What is the Licence Plate number# ?', 'AXBS-0001');
        $make = $this->ask('Who have made this ?', 'toyota');
        $model = $this->ask('Model number please ?', 'vitz');
        $made_in = $this->ask('Finally only need the date of manufacture ?', '2021-02-18');
        return compact('identifier', 'make', 'model', 'made_in');
    }
}
