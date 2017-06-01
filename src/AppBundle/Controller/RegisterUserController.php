<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Description of RegisterUserController
 *
 * @author yuwah
 */
class RegisterUserController extends Controller{
    //put your code here
    /**
     * @Route("/user/register")
     * @Method("POST")
     */
    public function registerAction(Request $request) {
        //get serializer (json to object)
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        //get response object to return
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
        $logger = $this->get('logger');

        //get empty user obj
        $user = new User();

        //get the parameter from request obj        
        $content = $request->getContent();
        //dump($content);
            //make the content into array
        $param = json_decode($content,true);

        //serialize to json (from array to json)
        $jsonContent = $serializer->serialize($param, 'json');

        //serialize json to obj
        $user = $serializer->deserialize($jsonContent, 'AppBundle\Entity\User', 'json');
        
        $logger->info($content);
        
        $email = $user->getUEmail();
        //dump($email);
        
        $curdate = new \DateTime("now");
        $user->setUCreatedate($curdate);
        $user->setUModifydate($curdate);
        
        $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
        $user->setUPassword($password);
        
        $existuser = new User();
        $em = $this->getDoctrine()->getManager();
        $existuser = $em->getRepository('AppBundle:User')
            ->findByMail($email); 
        
        
        if(is_null($existuser)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $response->setData(array("status"=>"success","message"=>$user->getUId()));
        }
        else{
            return $response->setData(array("status"=>"fail","message"=>"Email already exist."));
        }
    }
    
    /**
     * @Route("/user/login")
     * @Method("GET")
     */
    public function loginAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
	$logger = $this->get('logger');
 	
        //$session = new Session();
	$session = $this->get('session');

        $user = new User();
        $email = $request->query->get("email");
	$password = $request->query->get("password");

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')
            ->findByMail($email);      
        
        
        if(is_null($user)){
            return $response->setData(array("status"=> "fail","message"=>"Wrong Email"));            

        }
        else{
            $factory = $this->get('security.encoder_factory');
            
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();

            if($encoder->isPasswordValid($user->getUPassword(), $password, $salt)) {
                return $response->setData(array("status"=>"success","message"=>$user->getUName()));
            } else {
                return $response->setData(array("status"=> "fail","message"=>"Wrong Password")); 
            }
            
        }
    }
}
