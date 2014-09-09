<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\proveedor;
use Pepe\PepeBundle\Form\proveedorType;

/**
 * proveedor controller.
 *
 */
class proveedorController extends Controller
{

    /**
     * Lists all proveedor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:proveedor')->findAll();

        return $this->render('PepeBundle:proveedor:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new proveedor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new proveedor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proveedor_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a proveedor entity.
     *
     * @param proveedor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(proveedor $entity)
    {
        $form = $this->createForm(new proveedorType(), $entity, array(
            'action' => $this->generateUrl('proveedor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new proveedor entity.
     *
     */
    public function newAction()
    {
        $entity = new proveedor();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proveedor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:proveedor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proveedor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a proveedor entity.
    *
    * @param proveedor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(proveedor $entity)
    {
        $form = $this->createForm(new proveedorType(), $entity, array(
            'action' => $this->generateUrl('proveedor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing proveedor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('proveedor_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a proveedor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:proveedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find proveedor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedor'));
    }

    /**
     * Creates a form to delete a proveedor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proveedor_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
