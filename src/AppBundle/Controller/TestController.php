<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

/**
 * Description of TestController
 *
 * @author yuwah
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;


class TestController extends Controller {
    /**
     * @Route("/pretest")
     */
    public function pretestaction(Request $request){
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin','*');
        $logger = $this->get('logger');
        
        $logger->info("pretest ok");
        return $response->setData(array("pretest"=>"success"));
    }
}
