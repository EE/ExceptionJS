<?php

namespace EE\ExceptionJSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception;
use Symfony\Component\HttpFoundation\Request;

class ExceptionJSController extends Controller
{
    public function catchErrorAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $logData = $request->getContent();

            json_decode($logData);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new BadRequestHttpException('No JSON content');
            }

            $logger = $this->get('logger');
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($this->get('kernel')->getRootDir().'/logs/'.$this->get('kernel')->getEnvironment().'.js.log', $logger::ERROR));
            $logger->err($logData);

            return $this->render('EEExceptionJSBundle:ExceptionJS:catchError.json.twig', array('data' => json_encode($logData)));
        }
        else {
            throw new BadRequestHttpException('No JSON request');
        }

    }

}
