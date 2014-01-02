<?php

// ./src/Calendar/Controller/ErrorController.php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\ComponentHttpKernel\Exception\FlattenException;

class ErrorController
{
    public function ExceptionAction( FlattenException $exception )
    {
        $msg = 'Sth went wrong! '.$exception->getMessage();
        
        return new Response( $msg, $exception->getStatusCode() );
    }
}
