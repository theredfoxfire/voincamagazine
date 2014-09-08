<?php
namespace Vm\VmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vm\VmBundle\Entity\Knowledge;
use Vm\VmBundle\Repository\AffiliateRepository;

class ApiController extends Controller
{
	public function listAction(Request $request, $token)
	{
		$em = $this->getDoctrine()->getManager();
		$knowledges = array();
		$rep = $em->getRepository('VmVmBundle:Affiliate');
		$affiliate = $rep->getForToken($token);
		
		if(!$affiliate){
			throw $this->createNotFoundException('This affiliate is does not exist!');
			}
		$rep = $em->getRepository('VmVmBundle:Knowledge');
		$new_knowledge = $rep->getNewKnowledge(null, null, null, $affiliate->getId());
		
		foreach($new_knowledge as $knowledge){
				$knowledges[$this->get('router')->generate('vm_knowledge_show', array(
            'id' => $knowledge->getId(),
            'category' => $knowledge->getCategorySlug(),
            'title' => $knowledge->getTitleSlug(),
            'writer' => $knowledge->getWriterSlug(),
            ), true)] = $knowledge->asArray($request->getHost());
			}
			
			$format = $request->getRequestFormat();
			$jsonData = json_encode($knowledges);
			
			if($format == "json"){
				$headers = array('Content-Type' => 'application/json');
				$response = new Response($jsonData, 200, $headers);
				
				return $response;
				}
				
			return $this->render('VmVmBundle:Api:knowledges.'.$format.'.twig', array('knowledges' => $knowledges));
	}
}
