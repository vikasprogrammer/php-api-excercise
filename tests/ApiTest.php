<?php

/** 
 * Tests for the api located at /vehicles/
 * Tests the controller App\Http\Controllers\ApiController
 */

class ApiTest extends TestCase
{

    protected function validOutput($count, $description)
    {
        return [
            'Count' => $count,
            'Description' => $description
        ];
    }

    protected function validOutputRatings($count, $description, $rating)
    {
        return [
            'Count' => $count,
            'Description' => $description,
            'CrashRating' => $rating
        ];
    }

    protected function invalidOutput()
    {
        return [
            'Count' => 0,
            'Results' => []
        ];
    }

    public function testGetVehiclesValid()
    {
        $this->json('GET', '/vehicles/2015/Audi/A3')
            ->seeJson($this->validOutput(4, '2015 Audi A3 4 DR AWD'));
    }

    public function testGetVehiclesInValid()
    {
        $this->json('GET', '/vehicles/undefined/Ford/Fusion')
            ->seeJson($this->invalidOutput());
    }

    public function testGetVehiclesInValid2()
    {
        $this->json('GET', '/vehicles/2015/Ford/Crown Victoria')
            ->seeJson($this->invalidOutput());
    }

    public function testGetVehiclesJsonValid()
    {
        $this->json('POST', '/vehicles', ["modelYear" => 2015, "manufacturer" => "Audi", "model" => "A3"])
            ->seeJson($this->validOutput(4, '2015 Audi A3 4 DR AWD'));
    }

    public function testGetVehiclesJsonInValid()
    {
        $this->json('POST', '/vehicles', ["modelYear" => "undefined", "manufacturer" => "Audi", "model" => "A3"])
            ->seeJson($this->invalidOutput());
    }

    public function testGetVehiclesValidWithRatings()
    {
        $this->json('GET', '/vehicles/2015/Audi/A3?withRating=true')
            ->seeJson($this->validOutputRatings(4, '2015 Audi A3 4 DR AWD', "5"));
    }

    public function testGetVehiclesInValidWithRatings()
    {
        $this->json('GET', '/vehicles/undefined/Ford/Fusion?withRating=true')
            ->seeJson($this->invalidOutput());
    }
}