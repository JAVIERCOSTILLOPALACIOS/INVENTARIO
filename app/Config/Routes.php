
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MENU', 'Menu::index');
$routes->get('areas', 'Areas::index'); 
$routes->get('tipos_aparatos','Tipo_aparatos::index');

// Rutas para aparatos
$routes->get('aparatos', 'Aparatos::index'); // Mostrar la lista de aparatos
$routes->get('aparatos/create', 'Aparatos::create'); // Mostrar el formulario para agregar un aparato
$routes->post('aparatos/create', 'Aparatos::new'); // Manejar el envío del formulario para crear un aparato
$routes->get('aparatos/edit/(:num)', 'Aparatos::edit/$1'); // Mostrar el formulario para editar un aparato
$routes->post('aparatos/update/(:num)', 'Aparatos::update/$1'); // Manejar el envío del formulario de edición
$routes->get('aparatos/delete/(:num)', 'Aparatos::delete/$1'); // Eliminar un aparato


// Rutas para empleados
$routes->get('empleados', 'Empleados::index'); // Mostrar la lista de empleados
$routes->get('empleados/create', 'Empleados::create'); // Mostrar el formulario para agregar un empleado
$routes->post('empleados/create', 'Empleados::new'); // Manejar el envío del formulario para crear un empleado
$routes->get('empleados/edit/(:num)', 'Empleados::edit/$1'); // Mostrar el formulario para editar un empleado
$routes->post('empleados/update/(:num)', 'Empleados::update/$1'); // Manejar el envío del formulario de edición
$routes->get('empleados/delete/(:num)', 'Empleados::delete/$1'); // Eliminar un empleado


$routes->get('responsivas', 'Responsivas::index'); // Mostrar la lista de responsivas
$routes->get('responsivas/create', 'Responsivas::create'); // Mostrar el formulario para agregar una responsiva
$routes->post('responsivas/new', 'Responsivas::new'); // Manejar el envío del formulario para crear una responsiva
$routes->get('responsivas/darBaja/(:num)', 'Responsivas::darBaja/$1'); // Dar de baja una responsiva
$routes->get('responsivas/download/(:num)', 'Responsivas::download/$1'); // Descargar PDF
$routes->get('responsivas/generatePdf/(:num)', 'Responsivas::generatePdf/$1'); // Generar PDF (si lo necesitas)
