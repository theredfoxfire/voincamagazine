<?php

namespace Vm\VmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vm\VmBundle\Entity\Commenter;
use Vm\VmBundle\Form\CommenterType;

/**
 * Commenter controller.
 *
 */
class CommenterController extends Controller
{

    /**
     * Lists all Commenter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VmVmBundle:Commenter')->findAll();

        return $this->render('VmVmBundle:Commenter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Commenter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Commenter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vm-knowledge_show', array('id' => $entity->getId())));
        }

        return $this->render('VmVmBundle:Commenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Commenter entity.
     *
     * @param Commenter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commenter $entity)
    {
        $form = $this->createForm(new CommenterType(), $entity, array(
            'action' => $this->generateUrl('vm-commenter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Commenter entity.
     *
     */
    public function newAction()
    {
        $entity = new Commenter();
        $form   = $this->createCreateForm($entity);

        return $this->render('VmVmBundle:Commenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commenter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Commenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VmVmBundle:Commenter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commenter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Commenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commenter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VmVmBundle:Commenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Commenter entity.
    *
    * @param Commenter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commenter $entity)
    {
        $form = $this->createForm(new CommenterType(), $entity, array(
            'action' => $this->generateUrl('vm-commenter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Commenter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Commenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vm-commenter_edit', array('id' => $id)));
        }

        return $this->render('VmVmBundle:Commenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Commenter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VmVmBundle:Commenter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commenter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vm-commenter'));
    }

    /**
     * Creates a form to delete a Commenter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vm-commenter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
