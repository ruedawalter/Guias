<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

URL::forceRootUrl('/');

Route::get('/', function () {
    return view('home');
});

// Route::get('RolController@index', function(){
// 	$items=Rol::get();
//    	return view('auth.register',compact('items'));

// });
//Rutas Usuarios
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Agentes

Route::resource('agentes', 'AgenteController');

//Distritos

Route::resource('distritos', 'DistritoController');

//Bancos
Route::resource('bancos', 'BancoController');

// Buscar Guia
Route::resource('busg','BusgController');
Route::get('busg/{id?}', 'BusgController@edit')->name('busg.edit');

//Clientes

Route::resource('clientes', 'ClienteController');

Route::get('cliente','ClienteController@cargarSelect')->name('cliente.cargarSelect');

//Estados de las Guias (en proceso, entregado, devuelto, reprogrmado, etc)

Route::resource('estados', 'EstadoController');

// Forma de Pago (Efectivo, transferencia, credito, ect)

Route::resource('fpagos', 'FpagoController');

//Guias
// Administrador
// Route::get('admguias','GuiaController@index')->name('guiaindex');
// Route::get('admguias','GuiaController@store')->name('guiastore');


// Route::get('/admguias/{id?}', 'GuiaController@show')->name('admguias.show');
Route::resource('admguias', 'GuiaController');
Route::get('admguias/{id?}', 'GuiaController@show')->name('admguias.show');
Route::get('admguias/{cod?}/{id?}', 'GuiaController@bRemitente')->name('admguias.bRemitente');
// Agente
Route::resource('aguias', 'GuiagController');
Route::get('aguias/{id?}', 'GuiagController@show')->name('aguias.show');
Route::get('aguias/{cod?}/{id?}', 'GuiagController@bRemitente')->name('aguias.bRemitente');
// Remitente
Route::resource('remguias', 'GuiaremController');
Route::get('remguias/{id?}', 'GuiaremController@show')->name('remguias.show');
// Route::resource('remguias', 'GuiaremController');
// Agente
// Route::resource('aguias', 'GuiagController');
// buscar cliente
// Route::get('admguias/{id?}', 'GuiaController@buscarRem')->name('admguias.buscarRem');

// Route::get('/admguias/{id?}', 'BuscarController@bCliente')->name('bCliente');





//Proveedores

Route::resource('remitentes', 'RemitenteController');


//Servicios

Route::resource('servicios', 'ServicioController');


//Usuarios solo para edicion y supresion
Route::resource('usuarios', 'UsuarioController');
Route::get('usuarios/index', 'UsuarioController@index')->name('iniciousuarios');

// Reportes
Route::get('/pdf', 'PDFController@PDF')->name('VerPdf');
Route::put('/pdfguias', 'PDFController@PDFGuias')->name('Pdfguia');
Route::put('/pdfguiar', 'PDFController@PDFGuiasR')->name('PdfguiaR');
Route::put('/pdfguiaa', 'PDFController@PDFGuiasA')->name('PdfguiaA');
Route::put('/pdfguiarem', 'PDFController@PDFGuiasRem')->name('PdfguiaRem');
Route::put('/pdfguiaag', 'PDFController@PDFGuiasAg')->name('PdfguiaAg');




