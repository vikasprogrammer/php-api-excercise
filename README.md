## Overview

This repository holds API for accessing vehicle data from NHTSA Child Safety Seat Inspection Station Locator. 

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

To get vehicle data using a GET request 

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


