<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\condicionPago;
use Pepe\PepeBundle\Form\condicionPagoType;

/**
 * condicionPago controller.
 *
 */
class condicionPagoController extends Controller
{

    /**
     * Lists all condicionPago entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:condicionPago')->findAll();

        return $this->render('PepeBundle:condicionPago:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new condicionPago entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new condicionPago();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('condicionpago_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:condicionPago:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a condicionPago entity.
     *
     * @param condicionPago $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(condicionPago $entity)
    {
        $form = $this->createForm(new condicionPagoType(), $entity, array(
            'action' => $this->generateUrl('condicionpago_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new condicionPago entity.
     *
     */
    public function newAction()
    {
        $entity = new condicionPago();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:condicionPago:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a condicionPago entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:condicionPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find condicionPago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:condicionPago:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing condicionPago entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:condicionPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find condicionPago entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:condicionPago:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a condicionPago entity.
    *
    * @param condicionPago $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(condicionPago $entity)
    {
        $form = $this->createForm(new condicionPagoType(), $entity, array(
            'action' => $this->generateUrl('condicionpago_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing condicionPago entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:condicionPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find condicionPago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('condicionpago_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:condicionPago:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a condicionPago entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:condicionPago')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find condicionPago entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('condicionpago'));
    }

    /**
     * Creates a form to delete a condicionPago entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('condicionpago_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
