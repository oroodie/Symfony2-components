<?php
 
// example.com/src/Simplex/ContentLengthListener.php
 
namespace Simplex\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Simplex\ResponseEvent;
 
class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;
 
        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }
    
    public static function getSubscribedEvents()
    {
        return array('response' => array('onResponse', -255));
    }
}