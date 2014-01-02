<?php 

// ./src/Simplex/Listeners/StringResponseListener.php

namespace Simplex\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class StringResponseListener implements EventSubscriberInterface
{
    public function onView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();// controller return
        
        $event->setResponse( new Response($response.' kernel.view event') );
    }
    
    public static function getSubscribedEvents()
    {
        return array('kernel.view' => 'onView');
    }
}