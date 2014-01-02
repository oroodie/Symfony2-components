<?php
 
// example.com/web/front.php
 
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
 
    return new Response(ob_get_clean());
}
 phpinfo();
$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app-7.php';

// request context, matcher (routes - context), resolver (return controller, arguments)
$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

// dispatcher
$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new Simplex\Listeners\ContentLengthListener());
$dispatcher->addSubscriber(new Simplex\Listeners\GoogleListener());
 
$framework = new Simplex\Framework($dispatcher, $matcher, $resolver);

// add cache support
$framework = new HttpCache($framework, new Store(__DIR__.'/../cache'));

//$framework->handle($request)->send();

$response = $framework->handle($request); 

// cache configuration
$date = date_create_from_format('Y-m-d H:i:s', '2005-10-15 10:00:00'); 
$response->setCache(array(
    'public'        => true,
    'etag'          => 'abcde',
    'last_modified' => $date,
    'max_age'       => 10,
    's_maxage'      => 10,
));

$response->send();
