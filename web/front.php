<?php
 
// example.com/web/front.php
 
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

$request = Request::CreateFromGlobals();
$routes = include __DIR__.'\..\src\app-7.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));

$listener = new HttpKernel\EventListener\ExceptionListener('Calendar\\Controller\\ErrorController::IndexAction');
$dispatcher->addSubscriber($listener);

$dispatcher->addSubscriber(new Simplex\Listeners\StringResponseListener());

$framework = new Simplex\Framework($dispatcher, $resolver);

$response = $framework->handle($request);
$response->send();

