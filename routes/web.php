<?php

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



Route::get('/Admin/Compania', 'CompaniaController@index');
Route::get('/Admin/Compania/New', 'CompaniaController@new');
Route::get('/Admin/Compania/Edit/{id}', 'CompaniaController@edit');
Route::get('/Admin/Compania/Delete/{id}', 'CompaniaController@prepare');



Route::post('/Admin/Compania/Create', 'CompaniaController@store')->name('CreateCompany');
Route::put('/Admin/Compania/Update/{id}', 'CompaniaController@update')->name('UpdateCompany');
Route::post('/Admin/Compania/Delete/{id}', 'CompaniaController@delete')->name('DeleteCompany');

Route::get('/Admin/Roles', 'RolesController@index');
Route::get('/Admin/Roles/New', 'RolesController@new');
Route::get('/Admin/Roles/Edit/{id}', 'RolesController@edit');

Route::post('/Admin/Roles/Create', 'RolesController@create');
Route::post('/Admin/Roles/Update', 'RolesController@update');
Route::post('/Admin/Roles/Delete/{id}', 'RolesController@delete');

Route::get('/Admin/Areas','AreaController@index');
Route::get('/Admin/Areas/New', 'AreaController@new');
Route::get('/Admin/Areas/Edit/{id}', 'AreaController@edit');

Route::post('/Admin/Areas/Create', 'AreaController@create');
Route::post('/Admin/Areas/Update', 'AreaController@update');
Route::post('/Admin/Areas/Delete/{id}', 'AreaController@delete');

Route::get('/Admin/Puestos', 'PuestosController@index');
Route::get('/Admin/Puestos/New', 'PuestosController@new');
Route::get('/Admin/Puestos/Edit/{id}', 'PuestosController@edit');

Route::post('/Admin/Puestos/Create', 'PuestosController@create');
Route::post('/Admin/Puestos/Update', 'PuestosController@update');
Route::post('/Admin/Puestos/Delete/{id}', 'PuestosController@delete');

Route::get('/Admin/Status', 'StatusController@index');
Route::get('/Admin/Status/New', 'StatusController@new');
Route::get('/Admin/Status/Edit/{id}', 'StatusController@edit');

Route::post('/Admin/Status/Create', 'StatusController@create');
Route::post('/Admin/Status/Update', 'StatusController@update');
Route::post('/Admin/Status/Delete/{id}', 'StatusController@delete');

Route::get('/Admin/Proyectos', 'ProyectosController@index');
Route::get('/Admin/Proyectos/New','ProyectosController@new');
Route::get('/Admin/Proyectos/Edit/{id}','ProyectosController@edit');
Route::get('/Admin/Proyectos/ProyectByCompany/{company}','ProyectosController@ProyectByCompany');

Route::post('/Admin/Proyectos/Create','ProyectosController@create');
Route::post('/Admin/Proyectos/Update','ProyectosController@update');
Route::post('/Admin/Proyectos/Delete/{id}','ProyectosController@delete');

Route::get('/Admin/Usuarios', 'UsuariosController@index');
Route::get('/Admin/Usuarios/New', 'UsuariosController@new');
Route::get('/Admin/Usuarios/Edit/{id}', 'UsuariosController@edit');
Route::get('/Admin/Usuarios/ChangePassword/{id}', 'UsuariosController@changePassword');
Route::get('/Admin/Usuarios/ImportExcelIndex', 'UsuariosController@ImportExcelIndex');
Route::post('/Admin/Usuarios/importData', 'UsuariosController@importData');
//Route::get('/Admin/Usuarios/UsersByProyect/{proyecto}', 'UsuariosController@UsersByProyect');

Route::post('/Admin/Usuarios/Create', 'UsuariosController@create');
Route::post('/Admin/Usuarios/Update', 'UsuariosController@update');
Route::post('/Admin/Usuarios/Delete/{id}', 'UsuariosController@delete');
Route::post('/Admin/Usuarios/UpdatePassword', 'UsuariosController@updatePassword');
Route::get('/Admin/Usuarios/ChangeCompany/{id}', 'UsuariosController@changeCompany');



Route::get('/Admin/Actividades', 'ActividadesController@index');
Route::get('/Admin/Actividades/New', 'ActividadesController@new');
Route::get('/Admin/Actividades/Edit/{id}', 'ActividadesController@edit');

Route::post('/Admin/Actividades/Create', 'ActividadesController@create');
Route::post('/Admin/Actividades/Update', 'ActividadesController@update');
Route::post('/Admin/Actividades/Delete/{id}', 'ActividadesController@delete');

Route::get('/Admin/RolesProyectos', 'RolesProyectosController@index');
Route::get('/Admin/RolesProyectos/New', 'RolesProyectosController@new');
Route::get('/Admin/RolesProyectos/Edit/{id}', 'RolesProyectosController@edit');

Route::post('/Admin/RolesProyectos/Create', 'RolesProyectosController@create');
Route::post('/Admin/RolesProyectos/Update', 'RolesProyectosController@update');
Route::post('/Admin/RolesProyectos/Delete/{id}', 'RolesProyectosController@delete');

Route::get('/Admin/RolesRASIC', 'RolesRASICController@index');
Route::get('/Admin/RolesRASIC/New', 'RolesRASICController@new');
Route::get('/Admin/RolesRASIC/Edit/{id}', 'RolesRASICController@edit');

Route::post('/Admin/RolesRASIC/Create', 'RolesRASICController@create');
Route::post('/Admin/RolesRASIC/Update', 'RolesRASICController@update');
Route::post('/Admin/RolesRASIC/Delete/{id}', 'RolesRASICController@delete');

Route::get('/Admin/Indicador', 'IndicadorController@index');
Route::get('/Admin/Indicador/New', 'IndicadorController@new');
Route::get('/Admin/Indicador/Edit/{id}', 'IndicadorController@edit');

Route::post('/Admin/Indicador/Create', 'IndicadorController@create');
Route::post('/Admin/Indicador/Update', 'IndicadorController@update');
Route::post('/Admin/Indicador/Delete/{id}', 'IndicadorController@delete');

Route::get('/Admin/Fases', 'FasesController@index');
Route::get('/Admin/Fases/New', 'FasesController@new');
Route::get('/Admin/Fases/Edit/{id}', 'FasesController@edit');

Route::post('/Admin/Fases/Create', 'FasesController@create');
Route::post('/Admin/Fases/Update', 'FasesController@update');
Route::post('/Admin/Fases/Delete/{id}', 'FasesController@delete');

Route::get('/Admin/Enfoques', 'EnfoquesController@index');
Route::get('/Admin/Enfoques/New', 'EnfoquesController@new');
Route::get('/Admin/Enfoques/Edit/{id}', 'EnfoquesController@edit');

Route::post('/Admin/Enfoques/Create', 'EnfoquesController@create');
Route::post('/Admin/Enfoques/Update', 'EnfoquesController@update');
Route::post('/Admin/Enfoques/Delete/{id}', 'EnfoquesController@delete');


Route::get('/Admin/Trabajos', 'TrabajosController@index');
Route::get('/Admin/Trabajos/New', 'TrabajosController@new');
Route::get('/Admin/Trabajos/Edit/{id}', 'TrabajosController@edit');

Route::post('/Admin/Trabajos/Create', 'TrabajosController@create');
Route::post('/Admin/Trabajos/Update', 'TrabajosController@update');
Route::post('/Admin/Trabajos/Delete/{id}', 'TrabajosController@delete');

Route::get('/Admin/RolesFases', 'RolesFaseController@index');
Route::get('/Admin/RolesFases/New', 'RolesFaseController@new');
Route::get('/Admin/RolesFases/Edit/{id}', 'RolesFaseController@edit');

Route::post('/Admin/RolesFases/Create', 'RolesFaseController@create');
Route::post('/Admin/RolesFases/Update', 'RolesFaseController@update');
Route::post('/Admin/RolesFases/Delete/{id}', 'RolesFaseController@delete');


Route::get('/Reportes/ActividadesEmpresaPorEnfoque', 'ReportesController@ActividadesEmpresaPorEnfoque');
Route::get('/Reportes/Proyectos', 'ReportesController@proyectos');
Route::get('/Reportes/Recursos', 'ReportesController@recursosPorRoles');

Route::get('/Reportes/ActividadesEmpresaPorStatus', 'ReportesController@ActividadesEmpresaPorStatus');
/**/
Route::get('/Email/Usuarios','EmailController@index');
Route::get('/Email/SendReporteAsignacionesEnfoque','EmailController@SendReporteAsignacionesEnfoque');
Route::get('/Email/Send','EmailController@send');
/**/
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home','HomeController@index');

Route::get('/home/selectCompany','HomeController@selectCompany');
Route::get('/home/Add/Proyecto','HomeController@AddUser');
Route::get('/home/deletes/Proyecto','HomeController@DeleteUser');
Route::get('/home/email/nuevaactividad','HomeController@send');

Route::get('/home/create','HomeController@create');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


