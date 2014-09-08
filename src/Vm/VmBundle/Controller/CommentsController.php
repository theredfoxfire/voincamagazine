<?php

namespace Vm\VmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vm\VmBundle\Entity\Comments;
use Vm\VmBundle\Form\CommentsType;

/**
 * Comments controller.
 *
 */
class CommentsController extends Controller
{

    /**
     * Lists all Comments entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VmVmBundle:Comments')->findAll();

        return $this->render('VmVmBundle:Comments:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Comments entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Comments();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vm-comments_show', array('id' => $entity->getId())));
        }

        return $this->render('VmVmBundle:Comments:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Comments entity.
     *
     * @param Comments $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Comments $entity)
    {
        $form = $this->createForm(new CommentsType(), $entity, array(
            'action' => $this->generateUrl('vm-comments_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Comments entity.
     *
     */
    public function newAction()
    {
        $entity = new Comments();
        $form   = $this->createCreateForm($entity);

        return $this->render('VmVmBundle:Comments:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comments entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Comments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VmVmBundle:Comments:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comments entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Comments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comments entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VmVmBundle:Comments:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Comments entity.
    *
    * @param Comments $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Comments $entity)
    {
        $form = $this->createForm(new CommentsType(), $entity, array(
            'action' => $this->generateUrl('vm-comments_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Comments entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VmVmBundle:Comments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vm-comments_edit', array('id' => $id)));
        }

        return $this->render('VmVmBundle:Comments:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Comments entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VmVmBundle:Comments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vm-comments'));
    }

    /**
     * Creates a form to delete a Comments entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vm-comments_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
