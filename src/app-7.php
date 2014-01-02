<?php
 
// example.com/src/app.php
 
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;


$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', array('name' => 'World :)', '_controller' => 'render_template')));
$routes->add('bye', new Routing\Route('/bye'), array('_controller' => 'render_template'));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => date('Y'),
    '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction'
)));
 
return $routes;