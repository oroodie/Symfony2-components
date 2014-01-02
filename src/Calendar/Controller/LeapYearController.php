<?php
 
// example.com/src/Calendar/Controller/LeapYearController.php
 
namespace Calendar\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;
 
class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year)) {
            /*11 kernel.view */ return 'Yep, this is a leap year! ';
            $response = new Response('Yep, this is a leap year! '.rand()/*check cache*/);
        }
        else    
            /*11 kernel.view */ return 'Nope, this is not a leap year.';
            $response =  new Response('Nope, this is not a leap year. '.rand()/*check cahce*/);
        
        // set 10s cache
        $response->setTtl(10);
        
        return $response;
    }
}