<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//for JsonResponse
use Symfony\Component\HttpFoundation\JsonResponse;
class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }

    /**
    * @Route("/api/lucky/number")
    */
    public function apiNumberAction()
    {
   // 	$data = array(
    //		'lucky_number' => rand(0, 100),
//		'testing' => 'haha',
  //  	);
$data = array(
        'success' => true,
        'content' => array(
         'main_content' => 'A long string',
         'secondary_content' => 'another string'
        )
      );    
	// calls json_encode() and sets the Content-Type header
	return new JsonResponse($data);
    }

/**
* @Route("/lucky/number/{count}")
*/
public function numberCountAction($count)
{
$numbers = array();
for ($i = 0; $i < $count; $i++) {
$numbers[] = rand(0, 100);
}
$numbersList = implode(', ', $numbers);
return new Response(
'<html><body>Lucky numbers: '.$numbersList.'</body></html>'
);
}

}
