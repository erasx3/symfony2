<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\factura;
use Pepe\PepeBundle\Entity\detalle;
use Pepe\PepeBundle\Form\facturaType;

/**
 * factura controller.
 *
 */
class facturaController extends Controller
{

    /**
     * Lists all factura entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:factura')->findAll();

        return $this->render('PepeBundle:factura:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new factura entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new factura();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('factura_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:factura:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a factura entity.
     *
     * @param factura $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(factura $entity)
    {
        $form = $this->createForm(new facturaType(), $entity, array(
            'action' => $this->generateUrl('factura_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new factura entity.
     *
     */
    public function newAction()
    {
        $entity = new factura();
        
        
        $form   = $this->createCreateForm($entity);
        
        

        return $this->render('PepeBundle:factura:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a factura entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:factura:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing factura entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:factura:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a factura entity.
    *
    * @param factura $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(factura $entity)
    {
        $form = $this->createForm(new facturaType(), $entity, array(
            'action' => $this->generateUrl('factura_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing factura entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('factura_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:factura:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a factura entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:factura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find factura entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('factura'));
    }

    /**
     * Creates a form to delete a factura entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('factura_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
