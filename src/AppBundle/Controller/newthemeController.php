<?php
// src/AppBundle/Controller/newthemeController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class newthemeController extends Controller
{
    /**
    * @Route("newtheme")
    */
    public function newthemeAction()
    {
      return $this->render('new/newtheme.html.twig');
    }
}
