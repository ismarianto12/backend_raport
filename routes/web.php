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
    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->get('siswa', 'SiswaController@index');
        $router->post('siswa/insert', 'SiswaController@store');
        $router->post('siswa/update/{id}', 'SiswaController@update');
        $router->post('siswa/show/{id}', 'SiswaController@show');
        $router->post('siswa/delete/{id}', 'SiswaController@delete');

        $router->get('nilai', 'Mapelcontroller@nilai');

        $router->get('mapel', 'Mapelcontroller@index');
        $router->post('mapel/insert', 'Mapelcontroller@store');
        $router->post('mapel/update/{id}', 'Mapelcontroller@update');
        $router->post('mapel/show/{id}', 'Mapelcontroller@show');
        $router->post('mapel/delete/{id}', 'Mapelcontroller@delete');
        $router->post('pdf', 'MapelController@SkFile');

        $router->get('kelas', 'KelasController@index');
        $router->post('kelas/insert', 'KelasController@store');
        $router->post('kelas/update/{id}', 'KelasController@update');
        $router->put('kelas/show/{id}', 'KelasController@show');
        $router->post('kelas/delete/{id}', 'KelasController@delete');

        $router->get('pegawai', 'PegawaiController@index');
        $router->get('level_akses', 'PegawaiController@level_akses');

        $router->post('pegawai/insert', 'PegawaiController@store');
        $router->post('pegawai/update/{params}', 'PegawaiController@update');
        $router->put('pegawai/show/{params}', 'PegawaiController@show');
        $router->post('pegawai/delete/{id}', 'PegawaiController@delete');

        $router->get('raport', 'RaportController@index');
        $router->post('raport/save', 'RaportController@save');
        $router->post('raport/update/{id}', 'RaportController@update');
        $router->get('raport/show/{id}', 'RaportController@show');
        $router->post('raport/delete/{id}', 'RaportController@delete');

        $router->get('semester', 'PenilaianController@semester');
        $router->get('tahun_akademik', 'PenilaianController@tahun_akademik');
        $router->post('getratings', 'RaportController@GetRatings');
        // $router->post('Semester/insert', 'SemesterController@store');
        // $router->post('Semester/update/{params}', 'SemesterController@update');
        // $router->put('Semester/show/{params}', 'SemesterController@show');
        // $router->post('Semester/delete/{params}', 'SemesterController@delete');

        $router->get('materi/all', 'MateriController@index');
        $router->get('materi/save', 'MateriController@save');
        $router->post('materi/update', 'MateriController@update');
        $router->get('/master/statushadir', 'SiswaController@statushadir');

        $router->get('login/', 'LoginController@index');
        $router->post('login/insert', 'LoginController@store');
        $router->post('login/update/{id}', 'LoginController@update');
        $router->get('login/show/{id}', 'LoginController@show');
        $router->post('login/delete/{id}', 'LoginController@delete');
    });
    $router->post('login', 'LoginController@accesslogin');
});
