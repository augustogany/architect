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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/arquitectos', function () {
    return view('people');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Grupo de rutas que comprueba usuario logeado
Route::middleware(['auth'])->group(function () {
	//Roles.
	Route::resource('roles','RoleController');

	//Users.
	Route::resource('users','UserController');

	//Sucursales.
	Route::resource('sucursales','SucursalController');

	//Sucursales_Usuarios (Asignacion de sucursales).
	Route::resource('sucursales_usuarios','Sucursal_usuarioController');

	//Perfil de usuario del sistema
	Route::resource('perfilusuario','PerfilusuarioController');

	//Categoria General
	Route::resource('categoriageneral','CategoriageneralController');
	Route::get('print_categoria_general','CategoriageneralController@print_categoria_general')->name('print_categoria_general');

	//Categoria Urbanizacion
	Route::resource('categoriaurbanizacion','CategoriaurbanizacionController');
	Route::get('print_categoria_urbanizacion','CategoriaurbanizacionController@print_categoria_urbanizacion')->name('print_categoria_urbanizacion');

	// Gestiones
	Route::resource('gestiones','GestionesController');

	//Proyectos Generales
	Route::resource('proyectogeneral','ProyectogeneralController');
	Route::get('getProyectogeneral','ProyectogeneralController@getProyectogeneral')->name('getProyectogeneral');

	//Proyectos Urbanizacion
	Route::resource('proyectourbanizacion','ProyectourbanizacionController');
	Route::get('getProyectourbanizacion','ProyectourbanizacionController@getProyectourbanizacion')->name('getProyectourbanizacion');

	//Personas - Arquitectos
	Route::resource('personas','PersonaController');

	Route::resource('galerias','GaleriaController');

	Route::get('personas/{id}/pagomensualidad','PersonaController@pagomensualidad_index')->name('personas.pagomensualidad.index');
	Route::get('personas/{id}/pagomensualidad/list/{gestion_id}','PersonaController@pagomensualidad_list');
	Route::post('personas/{id}/pagomensualidad/store','PersonaController@pagomensualidad_store')->name('personas.pagomensualidad.store');
	Route::get('personas/pagomensualidad/{id}/print','PersonaController@pagomensualidad_print')->name('personas.pagomensualidad.print');
	Route::post('personas/{id}/pagomensualidad/destroy','PersonaController@pagomensualidad_destroy')->name('personas.pagomensualidad.destroy');

	Route::get('personas/{id}/pagoanual','PersonaController@pagoanual_index')->name('personas.pagoanual.index');
	Route::post('personas/{id}/pagoanual/store','PersonaController@pagoanual_store')->name('personas.pagoanual.store');
	Route::get('personas/pagoanual/{id}/print','PersonaController@pagoanual_print')->name('personas.pagoanual.print');
	Route::post('personas/{id}/pagoanual/destroy','PersonaController@pagoanual_destroy')->name('personas.pagoanual.destroy');

	Route::get('personas/{id}/ventaservicio','PersonaController@ventaservicio_index')->name('personas.ventaservicio.index');
	Route::post('personas/{id}/ventaservicio/store','PersonaController@ventaservicio_store')->name('personas.ventaservicio.store');
	Route::post('personas/{id}/ventaservicio/destroy','PersonaController@ventaservicio_destroy')->name('personas.ventaservicio.destroy');
	Route::get('personas/ventaservicio/{id}/print','PersonaController@ventaservicio_print')->name('personas.ventaservicio.print');

	Route::get('personas/{id}/proyectogenerales','PersonaController@proyectogenerales_index')->name('personas.proyectogenerales.index');
	Route::post('personas/{id}/proyectogenerales/store','PersonaController@proyectogenerales_store')->name('personas.proyectogenerales.store');
	Route::post('personas/{id}/proyectogenerales/update','PersonaController@proyectogenerales_update')->name('personas.proyectogenerales.update');
	Route::post('personas/{id}/proyectogenerales/destroy','PersonaController@proyectogenerales_destroy')->name('personas.proyectogenerales.destroy');
	Route::get('personas/proyectogenerales/{id}/print','PersonaController@proyectogenerales_print')->name('personas.proyectogenerales.print');

	Route::get('personas/{id}/proyectourbanizacions','PersonaController@proyectourbanizacions_index')->name('personas.proyectourbanizacions.index');
	Route::post('personas/{id}/proyectourbanizacions/store','PersonaController@proyectourbanizacions_store')->name('personas.proyectourbanizacions.store');
	Route::post('personas/{id}/proyectourbanizacions/update','PersonaController@proyectourbanizacions_update')->name('personas.proyectourbanizacions.update');
	Route::post('personas/{id}/proyectourbanizacions/destroy','PersonaController@proyectourbanizacions_destroy')->name('personas.proyectourbanizacions.destroy');
	Route::get('personas/proyectourbanizacions/{id}/print','PersonaController@proyectourbanizacions_print')->name('personas.proyectourbanizacions.print');
	
	Route::get('getPersona','PersonaController@getPersona')->name('getPersona');
	Route::get('persona-list-excel','PersonaController@exportExcel')->name('exportExcel');
	Route::get('persona-list-pdf','PersonaController@exportPDF')->name('exportPDF');


	//Reportes proyectos generales
	Route::get('vista/pg_por_rango_de_fechas_view','VistasreportesController@pg_por_rango_de_fechas_view')->name('pg_por_rango_de_fechas_view');
	Route::post('reporte/pg_por_rango_de_fechas_report','ProyectogeneralController@pg_por_rango_de_fechas_report')->name('pg_por_rango_de_fechas_report');

	Route::get('vista/pg_por_arquitectos_view','VistasreportesController@pg_por_arquitectos_view')->name('pg_por_arquitectos_view');
	Route::post('reporte/pg_por_arquitectos_report','PersonaController@pg_por_arquitectos_report')->name('pg_por_arquitectos_report');

	Route::get('vista/pg_por_categorias_view','VistasreportesController@pg_por_categorias_view')->name('pg_por_categorias_view');
	Route::post('reporte/pg_por_categorias_report','CategoriageneralController@pg_por_categorias_report')->name('pg_por_categorias_report');

	//Reportes proyectos urbanizacion
	Route::get('vista/pu_por_rango_de_fechas_view','VistasreportesController@pu_por_rango_de_fechas_view')->name('pu_por_rango_de_fechas_view');
	Route::post('reporte/pu_por_rango_de_fechas_report','ProyectourbanizacionController@pu_por_rango_de_fechas_report')->name('pu_por_rango_de_fechas_report');

	Route::get('vista/pu_por_arquitectos_view','VistasreportesController@pu_por_arquitectos_view')->name('pu_por_arquitectos_view');
	Route::post('reporte/pu_por_arquitectos_report','PersonaController@pu_por_arquitectos_report')->name('pu_por_arquitectos_report');

	Route::get('vista/pu_por_categorias_view','VistasreportesController@pu_por_categorias_view')->name('pu_por_categorias_view');
	Route::post('reporte/pu_por_categorias_report','CategoriaurbanizacionController@pu_por_categorias_report')->name('pu_por_categorias_report');

	//Reportes Pago de Arquitectos por fechas
	Route::get('vista/pagodeuda_rangofecha_view','VistasreportesController@pagodeuda_rangofecha_view')->name('pagodeuda_rangofecha_view');
	Route::post('vista/pagodeuda_rangofecha_report','PersonaController@pagodeuda_rangofecha_report')->name('pagodeuda_rangofecha_report');

	//Reportes de Ventas por fechas
	Route::get('vista/ventaservicio_rangofecha_view','VistasreportesController@ventaservicio_rangofecha_view')->name('ventaservicio_rangofecha_view');
	Route::post('vista/ventaservicio_rangofecha_report','VentaservicioController@ventaservicio_rangofecha_report')->name('ventaservicio_rangofecha_report');


	Route::get('visitante', 'HomeController@visitante')->name('visitante');

	//Deuda Arqutectos.
	Route::resource('deudaarquitectos','DeudaarquitectoController');
	Route::get('getdeuda','DeudaarquitectoController@getdeuda')->name('getdeuda');
	Route::get('pdfdetalledeuda/{id}', 'DeudaarquitectoController@pdfdetalledeuda')->name('pdfdetalledeuda');

	//Venta de Servicios.
	Route::resource('ventaservicio','VentaservicioController');
	Route::get('getventaservicio','VentaservicioController@getventaservicio')->name('getventaservicio');
	Route::get('pdfdetalleventa/{id}', 'VentaservicioController@pdfdetalleventa')->name('pdfdetalleventa');

	//Tipo de Pagos.
	Route::resource('tipopagos','TipopagoController');
	Route::get('gettipopago','TipopagoController@gettipopago')->name('gettipopago');

	//Tipos de Servicios.
	Route::resource('tiposervicios','TiposervicioController');
	Route::get('gettiposervicio','TiposervicioController@gettiposervicio')->name('gettiposervicio');

	//ruta para reportes
	Route::get('reportes/proyectos','ConsultasController@proyectos_index')->name('reportes.proyectos');
	Route::post('reportes/proyectos/list','ConsultasController@proyectos_list')->name('reportes.proyectos.list');

	Route::get('reportes/ventas','ConsultasController@ventas_index')->name('reportes.ventas');
	Route::post('reportes/ventas/list','ConsultasController@ventas_list')->name('reportes.ventas.list');

	Route::get('reportes/mensualidades','ConsultasController@mensualidades_index')->name('reportes.mensualidades');
	Route::post('reportes/mensualidades/list','ConsultasController@mensualidades_list')->name('reportes.mensualidades.list');

	//ruta para el kardex personal
	Route::get('documentacion','DocumentacionController@index')->name('documentacion');
	Route::get('experiencias','DocumentacionController@getexperiencia')->name('experiencias');
	//guardar archivo del curriculo
	Route::post('/guardar', 'DocumentacionController@store');
	Route::post('/guardarexperiencia', 'DocumentacionController@store_experiencia')->name('guardarexperiencia');
	Route::post('/updateexperiencia', 'DocumentacionController@update_experiencia')->name('experiencias.update');
	Route::post('/deleteexperiencia', 'DocumentacionController@delete')->name('experiencia.delete');

	//ruta para los arquitectos deudores deudores
	Route::get('deudores','PerfilusuarioController@deudores_pdf')->name('deudores_pdf');

	//Ruta para agregar pagos atrasados
	Route::post('addpayment/{id}','DeudaarquitectoController@addpayment')->name('add.payment');

	//Ruta para exportar las planillas de ingresos a excel
	Route::get('reporte-planillas','ReportesController@ingresos_planillas_index')->name('indexplanillas');
	Route::post('planillas-ingresos-excel','PersonaController@exportPlanillasExcel')->name('exportPlanillaExcel');

	//reporte diario de ingresos
	Route::get('report_diario','ConsultasController@reporte_diario')->name('report_diario');

});
