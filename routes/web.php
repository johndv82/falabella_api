<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/productos', 'ProductoController@index');
$router->post('/productos', 'ProductoController@store');

$router->get('/clientes', 'ClienteController@index');
$router->post('/clientes', 'ClienteController@store');

$router->get('/carrito_cliente/{id}', 'CarritoController@listar');
$router->post('/carrito', 'CarritoController@store');
$router->delete('/carrito/{id}', 'CarritoController@delete');

$router->get('/direccion_cliente/{id}', 'DireccionController@listar');
$router->get('/direcciones/{id}', 'DireccionController@obtener');
$router->post('/direcciones', 'DireccionController@store');
$router->put('/direcciones/{id}', 'DireccionController@update');
$router->delete('/direcciones/{id}', 'DireccionController@delete');

$router->post('/pagos', 'PagoController@store');

$router->post('/despachos', 'DespachoController@store');

$router->post('/pedidos', 'PedidoController@store');
