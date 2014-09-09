<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\iva;
use Pepe\PepeBundle\Form\ivaType;

/**
 * iva controller.
 *
 */
class ivaController extends Controller
{

    /**
     * Lists all iva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:iva')->findAll();

        return $this->render('PepeBundle:iva:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new iva entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new iva();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('iva_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:iva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a iva entity.
     *
     * @param iva $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(iva $entity)
    {
        $form = $this->createForm(new ivaType(), $entity, array(
            'action' => $this->generateUrl('iva_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new iva entity.
     *
     */
    public function newAction()
    {
        $entity = new iva();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:iva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a iva entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:iva:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing iva entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:iva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a iva entity.
    *
    * @param iva $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(iva $entity)
    {
        $form = $this->createForm(new ivaType(), $entity, array(
            'action' => $this->generateUrl('iva_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing iva entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('iva_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:iva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a iva entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:iva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find iva entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('iva'));
    }

    /**
     * Creates a form to delete a iva entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('iva_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
