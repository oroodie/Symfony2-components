<?php
 
// example.com/src/app.php
 
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
 

function is_leap_year($year = null) {
    if (null === $year) {
        $year = date('Y');
    }
 
    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}


class LeapYearController
{
    public function indexAction($year)
    {
        if (is_leap_year($year)) {
            return new Response('Yep, this is a leap year!');
        }
 
        return new Response('Nope, this is not a leap year.');
    }
}
 

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', array('name' => 'World :)', '_controller' => 'render_template')));
$routes->add('bye', new Routing\Route('/bye'), array('_controller' => 'render_template'));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => date('Y'),
    '_controller' => 'LeapYearController::indexAction'
)));
 
return $routes;