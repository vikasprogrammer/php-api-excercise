<?php

namespace App\Http\Controllers;

use App\Nhtsa;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $nhtsa;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nhtsa = new Nhtsa();
    }

    /** 
     * Call the SafetyRatings api and transform the results.
     * 
     * @param \Illuminate\Http\Request $request
     * @param integer $year
     * @param string $make 
     * @param string $model
     * @return json
     */
    public function vehicalDetails(Request $request, $year, $make, $model)
    {
        //TODO Validation

        $url = "/SafetyRatings/modelyear/$year/make/$make/model/$model?format=json";
        $results = [];
        if ($response = $this->nhtsa->api($url)) {
            foreach ($response->Results as $vehicle) {

                $vehicleResult = [
                    'Description' => $vehicle->VehicleDescription,
                    'VehicleId' => $vehicle->VehicleId
                ];

                if ($request->input('withRating') === "true") {
                    $url = "/SafetyRatings/VehicleId/{$vehicle->VehicleId}?format=json";
                    if ($ratingResponse = $this->nhtsa->api($url)) {
                        try {
                            $vehicleResult['CrashRating'] = $ratingResponse->Results[0]->OverallRating;
                        } catch (\Exception $e) {
                            $vehicleResult['CrashRating'] = "Not Rated";
                        }
                    } else {
                        $vehicleResult['CrashRating'] = "Not Rated";
                    }
                }

                $results[] = $vehicleResult;
            }
        }



        return $this->nhtsa->output($results);
    }

    /** 
     * Accepts POST Json request and calls vehicalDetails to fetch Safety ratings. 
     * 
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function vehicalDetailsJson(Request $request)
    {

        $year = $request->input('modelYear');
        $make = $request->input('manufacturer');
        $model = $request->input('model');

        return $this->vehicalDetails($request, $year, $make, $model);
    }
}
