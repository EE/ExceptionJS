<?php

namespace EE\ExceptionJSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExceptionJSController extends Controller
{
    public function catchErrorAction()
    {
        $logData = $this->getRequest()->get('jsError');
        
        $logger = $this->get('logger');
        
        $logger->err(json_encode($logData));
        
        return $this->render('EEExceptionJSBundle:ExceptionJS:catchError.json.twig', array('data' => json_encode($logData)));
    }
}
