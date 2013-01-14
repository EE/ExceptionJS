<?php

namespace EE\ExceptionJSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExceptionJSController extends Controller
{
    public function catchErrorAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $logData = $request->getContent();

            json_decode($logData);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('No JSON content');
            }

            $logger = $this->get('logger');

            $logger->err($logData);

            return $this->render('EEExceptionJSBundle:ExceptionJS:catchError.json.twig', array('data' => json_encode($logData)));
        }
        else {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('No JSON request');
        }

    }

}