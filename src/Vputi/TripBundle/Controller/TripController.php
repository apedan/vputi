<?php

namespace Vputi\TripBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vputi\TripBundle\Entity\Trip;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Vputi\TripBundle\Dto\Trip as TripDto;
use Vputi\MainBundle\DtoService as DtoService;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Trip controller.
 *
 */
class TripController extends Controller
{

    /**
     * Lists all Trip entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->get('trip.repository')->findAll();

        return $this->render('TripBundle:Trip:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all active Trip entities.
     *
     */
    public function listAction()
    {
        $entities = $this->get('trip.repository')->findActive(5);

        return $this->render('TripBundle:Trip:list_block.html.twig', array(
            'entities'      => $entities,
            'list_length'   => 5,
        ));
    }

    /**
     * last active Trip entities.
     * @Rest\View
     */
    public function lastAction(Request $request)
    {
        $created = $request->query->get('created');
        $created = new \DateTime($created);

        $entities = $this->get('trip.repository')->findLast($created);

        return array(
            'code'      => 200,
            'entities'  => DtoService::objectToDto($entities, new TripDto()),
        );
    }

    /**
     * Creates a new Trip entity.
     *
     */
    public function createAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $trip = new Trip();

        $form = $this->createCreateForm($trip);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trip);
            $em->flush();

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($trip);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('trip_show', array('id' => $trip->getId())));
        }

        return $this->render('TripBundle:Trip:new.html.twig', array(
            'entity' => $trip,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Trip entity.
    *
    * @param Trip $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Trip $entity)
    {

        $form = $this->createForm('vputi_trip', $entity, array(
            'action' => $this->generateUrl('trip_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Trip entity.
     *
     */
    public function newAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $entity = new Trip();
        $form   = $this->createCreateForm($entity);

        return $this->render('TripBundle:Trip:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Trip entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->get('trip.repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trip entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TripBundle:Trip:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trip entity.
     *
     */
    public function editAction($id)
    {
        $trip = $this->get('trip.repository')->find($id);

        if (!$trip) {
            throw $this->createNotFoundException('Unable to find Trip entity.');
        }

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $trip)) {
            throw new AccessDeniedException();
        }

        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $editForm = $this->createEditForm($trip);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TripBundle:Trip:edit.html.twig', array(
            'entity'      => $trip,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Trip entity.
    *
    * @param Trip $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Trip $entity)
    {
        $form = $this->createForm('vputi_trip', $entity, array(
            'action' => $this->generateUrl('trip_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Trip entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->get('trip.repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trip entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_edit', array('id' => $id)));
        }

        return $this->render('TripBundle:Trip:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Trip entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->get('trip.repository')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Trip entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('trip'));
    }

    /**
     * Creates a form to delete a Trip entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trip_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'ui labeled button red')))
            ->getForm()
        ;
    }

    /**
     * Search form and filtered trip list
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $defaultData = array(
            'departure' => 'Харьков',
            'arrival'   => 'Черкассы',
        );
        $form = $this->createFormBuilder($defaultData)
            ->setAction($this->generateUrl('trip_search'))
            ->setMethod('POST')
            ->add('departure', 'text')
            ->add('arrival', 'text')
            ->add('search', 'submit', array('attr' => array('class' => 'ui labeled button teal')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $criteria = array();

            foreach ($data as $key => $param) {
                if (!empty($param)) {
                    $criteria[$key] = $param;
                }
            }

            $entities = $this->get('trip.repository')->findBy($criteria);

            return $this->render('TripBundle:Trip:search_page.html.twig', array(
                'form'      => $form->createView(),
                'data'      => $data,
                'error'     => $form->getErrors(),
                'entities'  => $entities,
            ));
        }

        return $this->render('TripBundle:Trip:search.html.twig', array(
            'form'      => $form->createView(),
        ));
    }
}
