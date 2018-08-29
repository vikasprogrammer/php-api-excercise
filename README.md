## Overview

This repository holds API for accessing vehicle data from NHTSA Child Safety Seat Inspection Station Locator. 

This API uses an upstream data provider located at 
[NHTSA NCAP 5 Star
Safety Ratings API](https://one.nhtsa.gov/webapi/Default.aspx?SafetyRatings/API/5)

## Installation

To install all the dependencies simply run. 

```
composer install
```

## Run

You can either use any PHP supporting servers like Apache or NGINX or use a standalone PHP server like this. 

```
php -S localhost:8080 -t ./public
```

## API Details

#### Get vehicle data using a GET request 

**Request**

`/vehicles/{year}/{make}/{model}`

For example 

`/vehicles/2015/Audi/A3` 

**Response**

```
{
  "Count": 4,
  "Results": [
    {
      "Description": "2015 Audi A3 4 DR AWD",
      "VehicleId": 9403
    },
    {
      "Description": "2015 Audi A3 4 DR FWD",
      "VehicleId": 9408
    },
    {
      "Description": "2015 Audi A3 C AWD",
      "VehicleId": 9405
    },
    {
      "Description": "2015 Audi A3 C FWD",
      "VehicleId": 9406
    }
  ]
}
```

#### Get vehicle data using a POST request with JSON params 

**Request**

```
POST /vehicles

{
	"modelYear": 2015,
	"manufacturer": "Audi",
    "model": "A3"
}
```

**Response**

Same as previous api request.

#### Get vehicle data using a GET request with Crash Ratings

**Request**

`/vehicles/{year}/{make}/{model}?withRating=true`

For example 

`/vehicles/2015/Audi/A3?withRating=true` 

**Response**

```
{
  "Count": 4,
  "Results": [
    {
      "Description": "2015 Audi A3 4 DR AWD",
      "VehicleId": 9403,
      "CrashRating": "5"
    },
    {
      "Description": "2015 Audi A3 4 DR FWD",
      "VehicleId": 9408,
      "CrashRating": "5"
    },
    {
      "Description": "2015 Audi A3 C AWD",
      "VehicleId": 9405,
      "CrashRating": "Not Rated"
    },
    {
      "Description": "2015 Audi A3 C FWD",
      "VehicleId": 9406,
      "CrashRating": "Not Rated"
    }
  ]
}
```

#### Empty or Error response

If the vehicle search parameters are not found or are invalid, the api will respond an empty array like this:

```
{
  "Count": 0,
  "Results": [
    
  ]
}
```
