<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\detalle;
use Pepe\PepeBundle\Form\detalleType;

/**
 * detalle controller.
 *
 */
class detalleController extends Controller
{

    /**
     * Lists all detalle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:detalle')->findAll();

        return $this->render('PepeBundle:detalle:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new detalle entity.
     *
     */
    public function createAction(Request $request,Factura $unaFactura)
    {
        $entity = new detalle();
        $entity->setFactura($unaFactura);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('detalle_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:detalle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a detalle entity.
     *
     * @param detalle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(detalle $entity)
    {
        $form = $this->createForm(new detalleType(), $entity, array(
            'action' => $this->generateUrl('detalle_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new detalle entity.
     *
     */
    public function newAction()
    {
        $entity = new detalle();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:detalle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a detalle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:detalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find detalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:detalle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing detalle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:detalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find detalle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:detalle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a detalle entity.
    *
    * @param detalle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(detalle $entity)
    {
        $form = $this->createForm(new detalleType(), $entity, array(
            'action' => $this->generateUrl('detalle_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing detalle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:detalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find detalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('detalle_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:detalle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a detalle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:detalle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find detalle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('detalle'));
    }

    /**
     * Creates a form to delete a detalle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detalle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
