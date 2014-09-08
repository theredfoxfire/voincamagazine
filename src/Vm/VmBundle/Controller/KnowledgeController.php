<?php

namespace Vm\VmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Vm\VmBundle\Entity\Knowledge;
use Vm\VmBundle\Form\KnowledgeType;
use Vm\VmBundle\Entity\Commenter;
use Vm\VmBundle\Entity\Comments;
use Vm\VmBundle\Form\CommenterType;

/**
 * Knowledge controller.
 *
 */
class KnowledgeController extends Controller
{

    /**
     * Lists all Knowledge entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $categories = $em->getRepository('VmVmBundle:Category')->getWithKnowledge($this->container->getParameter('max_category_home'));
        
        foreach($categories as $category){
			$category->setNewKnowledge($em->getRepository('VmVmBundle:Knowledge')->getNewKnowledge($category->getId(), $this->container->getParameter('max_knowledges_home')));
			$category->setMoreKnowledge($em->getRepository('VmVmBundle:Knowledge')->countActiveKnowledge($category->getId())-$this->container->getParameter('max_knowledges_home'));
			}
		$othercategory=$em->getRepository('VmVmBundle:Category')->getOthersCategory($this->container->getParameter('frc'), $this->container->getParameter('mxc'));
		$latestKnowledges = $em->getRepository('VmVmBundle:Knowledge')->getLatestPost();
		if($latestKnowledges){
			$lastUpdated = $latestKnowledges->getCreatedAt()->format(DATE_ATOM);
			} else {
				$lastUpdated = new \DateTime();
				$lastUpdated = $lastUpdated->format(DATE_ATOM);
				}
		
		$format = $this->getRequest()->getRequestFormat();
        return $this->render('VmVmBundle:Knowledge:index.'.$format.'.twig', array(
            'categories' => $categories,
            'lastUpdated' => $lastUpdated,
            'feedId' => sha1($this->get('router')->generate('vm_knowledge', array('_format' => 'atom'), true)),
            'othercategory' => $othercategory
        ));
    }
    /**
     * Creates a new Knowledge entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Knowledge();
        $form = $this->createCreateForm(new KnowledgeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('vm_knowledge_show', array('id' => $entity->getId(),
            'category' => $entity->getNameSlug(),
            'title' => $entity->getTitleSlug(),
            'writer' => $entity->getWriterSlug()
            )));
        }

        return $this->render('VmVmBundle:Knowledge:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Knowledge entity.
     *
     * @param Knowledge $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Knowledge $entity)
    {
        $form = $this->createForm(new KnowledgeType(), $entity, array(
            'action' => $this->generateUrl('vm_knowledge_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Knowledge entity.
     *
     */
    public function newAction()
    {
        $entity = new Knowledge();
        $form   = $this->createCreateForm($entity);

        return $this->render('VmVmBundle:Knowledge:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Knowledge entity.
     *
     */
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $entity = $em->getRepository('VmVmBundle:Knowledge')->getNewKnown($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Knowledge entity.');
        }
        $comment = $em->getRepository('VmVmBundle:Comments')->getKnowledgeComments($id);
        
        $crentity = new Commenter();
        $cs = new Comments();
        $form = $this->createCommenterForm($request, $crentity, $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
			$session->set('email', $crentity->getEmail());
			$session->set('nama', $crentity->getNama());
			$isSameEmail = $em->getRepository('VmVmBundle:Commenter')->findOneByEmail($crentity->getEmail());
			if($isSameEmail){
				$es = $this->getDoctrine()->getManager();
				$cs->setComments($crentity->getComment());
				$cs->setKnowledges($entity);
				$cs->setIsActivated(1);
				$cs->setCommenter($isSameEmail);
				$es->persist($cs);
				$es->flush();
				}
			else{
				$em = $this->getDoctrine()->getManager();
				$crentity->setIsApproved(1);
				$em->persist($crentity);
				$em->flush();
				$isSameEmail = $em->getRepository('VmVmBundle:Commenter')->findOneByEmail($crentity->getEmail());
				$es = $this->getDoctrine()->getManager();
				$cs->setComments($crentity->getComment());
				$cs->setIsActivated(1);
				$cs->setCommenter($isSameEmail);
				$cs->setKnowledges($entity);
				$es->persist($cs);
				$es->flush();
			}
			//$this->get('session')->getFlashBag()->add('notice', $crentity->getNama().', komentar anda sedang menunggu konfirmasi.');
            return $this->redirect($this->generateUrl('vm_knowledge_show', array(
            'id' => $entity->getId(),
            'category' => $entity->getCategorySlug(),
            'title' => $entity->getTitleSlug(),
            'writer' => $entity->getWriterSlug(),
            )));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VmVmBundle:Knowledge:show.html.twig', array(
            'entity'      => $entity,
            'comment'	  => $comment,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    private function createCommenterForm(Request $request, Commenter $entity, $entities)
    {
		$session = $request->getSession();
        $form = $this->createForm(new CommenterType(), $entity, array(
            'action' => $this->generateUrl('vm_knowledge_show', array(
            'id' => $entities->getId(),
            'category' => $entities->getCategorySlug(),
            'title' => $entities->getTitleSlug(),
            'writer' => $entities->getWriterSlug(),
            )),
            'method' => 'POST',
        ));
        $form->add('nama', 'text', array('attr'=>array('value'=>$session->get('nama'))));
        $form->add('email', 'email', array('attr'=>array('value'=>$session->get('email'))));

        return $form;
    }

    /**
     * Displays a form to edit an existing Knowledge entity.
     *
     */
    public function editAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Knowledge')->findOneByToken($token);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Knowledge entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($token);

        return $this->render('VmVmBundle:Knowledge:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Knowledge entity.
    *
    * @param Knowledge $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Knowledge $entity)
    {
        $form = $this->createForm(new KnowledgeType(), $entity, array(
            'action' => $this->generateUrl('vm_knowledge_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Knowledge entity.
     *
     */
    public function updateAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Knowledge')->findOneByToken($token);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Knowledge entity.');
        }
        $entity->setUpdatedAtValue();

        $deleteForm = $this->createDeleteForm($token);
        $editForm = $this->createForm(new KnowledgeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
			$em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vm_knowledge_show', array('id' => $entity->getId(),
            'category' => $entity->getNameSlug(),
            'title' => $entity->getTitleSlug(),
            'writer' => $entity->getWriterSlug()
            )));
        }

        return $this->render('VmVmBundle:Knowledge:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Knowledge entity.
     *
     */
    public function deleteAction(Request $request, $token)
    {
        $form = $this->createDeleteForm($token);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VmVmBundle:Knowledge')->findOneByToken($token);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Knowledge entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vm_knowledge'));
    }

    /**
     * Creates a form to delete a Knowledge entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vm_knowledge_delete', array('token' => $token)))
            ->add('token', 'hidden')
            ->getForm()
        ;
    }
    
    public function publishAction(Request $request, $token)
    {
		$form = $this->createPublishForm($token);
		$form->bind($request);
		
		if($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$entity = $em->getRepository('VmVmBundle:Knowledge')->findOneByToken($token);
			
			if(!$entity)
			{
				throw $this->createNotFoundException('Unable to find Job entity');
			}
			$entity->publish();
			$em->persist($entity);
		}
		
		return $this->redirect($this->generateUrl('vm_knowledge_show', array('id' => $entity->getId(),
            'category' => $entity->getNameSlug(),
            'title' => $entity->getTitleSlug(),
            'writer' => $entity->getWriterSlug()
            )));
	}
	
	private function createPublishForm($token)
	{
		return $this->createFormBuilder(array('token' => $token))
		->add('token', 'hidden')
		->getForm()
		;
	}
	
	public function searchAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$query = $this->getRequest()->get('query');
		
		if(!$query){
			return $this->redirect($this->generateUrl('vm_knowledge'));
		}
		
		$knowledges = $em->getRepository('VmVmBundle:Knowledge')->getForLuceneQuery($query);
		if(!$knowledges){
				$this->get('session')->getFlashBag()->add('notice', 'Ooops! kata yang Anda cari tidak ditemukan, coba dengan yang lain.');
			}
		
		return $this->render('VmVmBundle:Knowledge:search.html.twig', array('knowledges' => $knowledges, 'query' => $query));
	}
}
