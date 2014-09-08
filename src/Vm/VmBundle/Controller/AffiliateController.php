<?php
namespace Vm\VmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vm\VmBundle\Entity\Affiliate;
use Vm\VmBundle\Form\AffiliateType;
use Symfony\Component\HttpFoundation\Request;
use Vm\VmBundle\Entity\Category;

class AffiliateController extends Controller
{
	public function newAction()
	{
		$entity = new Affiliate();
		$form = $this->createForm(new AffiliateType(), $entity, array(
			'action' => $this->generateUrl('vm_affiliate_create'),
			'method' => 'POST',
			)
		);
		
		return $this->render('VmVmBundle:Affiliate:affiliate_new.html.twig', array('entity' => $entity, 'form' => $form->createView(),
		));
	}
	
	public function createAction(Request $request)
	{
		$affiliate = new Affiliate();
		$form = $this->createForm(new AffiliateType(), $affiliate, array(
				'action' => $this->generateUrl('vm_affiliate_create'),
				'method' => 'POST',
				)
			);
		$form->bind($request);
		$em = $this->getDoctrine()->getManager();
		
		if ($form->isValid()){
				
				$formData = $request->get('affiliate');
				$affiliate->setUrl($formData['url']);
				$affiliate->setEmail($formData['email']);
				$affiliate->setIsActive(false);
				
				$em->persist($affiliate);
				$em->flush();
				
				return $this->redirect($this->generateUrl('vm_affiliate_wait'));
			}
			
		return $this->render('VmVmBundle:Affiliate:affiliate_new.html.twig',
		array(
				'entity' => $affiliate,
				'form' => $form->createView(),
			));
	}
	
	public function waitAction()
	{
		return $this->render('VmVmBundle:Affiliate:wait.html.twig');
	}
}
