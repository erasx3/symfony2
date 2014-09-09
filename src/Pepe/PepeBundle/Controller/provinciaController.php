<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\provincia;
use Pepe\PepeBundle\Form\provinciaType;

/**
 * provincia controller.
 *
 */
class provinciaController extends Controller
{

    /**
     * Lists all provincia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:provincia')->findAll();

        return $this->render('PepeBundle:provincia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new provincia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new provincia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('provincia_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:provincia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a provincia entity.
     *
     * @param provincia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(provincia $entity)
    {
        $form = $this->createForm(new provinciaType(), $entity, array(
            'action' => $this->generateUrl('provincia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new provincia entity.
     *
     */
    public function newAction()
    {
        $entity = new provincia();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:provincia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a provincia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:provincia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find provincia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:provincia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing provincia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:provincia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find provincia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:provincia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a provincia entity.
    *
    * @param provincia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(provincia $entity)
    {
        $form = $this->createForm(new provinciaType(), $entity, array(
            'action' => $this->generateUrl('provincia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing provincia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:provincia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find provincia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('provincia_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:provincia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a provincia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:provincia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find provincia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('provincia'));
    }

    /**
     * Creates a form to delete a provincia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provincia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
