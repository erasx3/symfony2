<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pepe\PepeBundle\Entity\localidad;
use Pepe\PepeBundle\Form\localidadType;

/**
 * localidad controller.
 *
 */
class localidadController extends Controller
{

    /**
     * Lists all localidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PepeBundle:localidad')->findAll();

        return $this->render('PepeBundle:localidad:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new localidad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new localidad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('localidad_show', array('id' => $entity->getId())));
        }

        return $this->render('PepeBundle:localidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a localidad entity.
     *
     * @param localidad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(localidad $entity)
    {
        $form = $this->createForm(new localidadType(), $entity, array(
            'action' => $this->generateUrl('localidad_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new localidad entity.
     *
     */
    public function newAction()
    {
        $entity = new localidad();
        $form   = $this->createCreateForm($entity);

        return $this->render('PepeBundle:localidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a localidad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:localidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find localidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:localidad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing localidad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:localidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find localidad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PepeBundle:localidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a localidad entity.
    *
    * @param localidad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(localidad $entity)
    {
        $form = $this->createForm(new localidadType(), $entity, array(
            'action' => $this->generateUrl('localidad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing localidad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PepeBundle:localidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find localidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('localidad_edit', array('id' => $id)));
        }

        return $this->render('PepeBundle:localidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a localidad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PepeBundle:localidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find localidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('localidad'));
    }

    /**
     * Creates a form to delete a localidad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('localidad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    public function seleccionarAction() { {
            $provincia_id = $this->getRequest()->request->get('provincia_id');
            $em = $this->getDoctrine()->getManager();
            $localidades = $em->getRepository('PepeBundle:Localidad')->findByProvinciaId($provincia_id);
            return $this->render('PepeBundle:Localidad:localidades.html.twig', array(
                        "localidades" => $localidades
            ));
        }
    }
}
