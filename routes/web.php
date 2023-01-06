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
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    // may also be using PUT, PATCH, HEAD etc
    {
        header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    exit(0);
}

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->get('siswa', 'SiswaController@index');
    $router->post('siswa/insert', 'SiswaController@store');
    $router->post('siswa/update/{id}', 'SiswaController@update');
    $router->get('siswa/show/{id}', 'SiswaController@show');
    $router->post('siswa/delete/{id}', 'SiswaController@delete');



    $router->get('nilai', 'Mapelcontroller@nilai');

    $router->get('mapel', 'Mapelcontroller@index');
    $router->post('mapel/insert', 'Mapelcontroller@store');
    $router->post('mapel/update/{params}', 'Mapelcontroller@update');
    $router->put('mapel/show/{params}', 'Mapelcontroller@show');
    $router->post('mapel/delete/{params}', 'Mapelcontroller@delete');


    $router->get('kelas', 'KelasController@index');
    $router->post('kelas/insert', 'KelasController@store');
    $router->post('kelas/update/{params}', 'KelasController@update');
    $router->put('kelas/show/{params}', 'KelasController@show');
    $router->post('kelas/delete/{params}', 'KelasController@delete');


    $router->get('pegawai', 'PegawaiController@index');
    $router->post('pegawai/insert', 'PegawaiController@store');
    $router->post('pegawai/update/{params}', 'PegawaiController@update');
    $router->put('pegawai/show/{params}', 'PegawaiController@show');
    $router->post('pegawai/delete/{params}', 'PegawaiController@delete');


    $router->get('raport', 'RaportController@index');
    $router->post('raport/save', 'RaportController@save');
    $router->post('raport/update/{id}', 'RaportController@update');
    $router->get('raport/show/{id}', 'RaportController@show');
    $router->post('raport/delete/{id}', 'RaportController@delete');


    $router->post('login', 'LoginController@accesslogin');

    $router->post('Login/insert', 'LoginController@store');
    $router->post('Login/update/{params}', 'LoginController@update');
    $router->put('Login/show/{params}', 'LoginController@show');
    $router->post('Login/delete/{params}', 'LoginController@delete');


    // get master data
});
