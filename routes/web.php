<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

/** With Validations */
// $router->get('/vehicles/{year:[0-9]+}/{make:[a-zA-Z0-9 ]+}/{model:[a-zA-Z0-9 ]+}', 'ApiController@vehicalDetails');

/** Without Validations */
$router->get('/vehicles/{year}/{make}/{model}', 'ApiController@vehicalDetails');
$router->post('/vehicles', 'ApiController@vehicalDetailsJson');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
