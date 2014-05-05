<?php

namespace Vputi\EventBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\ClassBasedInterface;
use Vputi\EventBundle\Dto\Event as EventDto;
use Vputi\MainBundle\DtoService as DtoService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vputi\EventBundle\Form\Type\EventFormType;

use Vputi\EventBundle\Entity\Event;
use Vputi\EventBundle\EventService;

use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;

use Symfony\Component\HttpFoundation\Response;

/**
 * Rest API Event controller.
 * Route (api/v1/events)
 * @RouteResource("Event")
 */
class ApiController extends FOSRestController implements ClassResourceInterface
{
    public function processForm(Event $event)
    {
//        var_dump($this->getRequest()); die();
        $statusCode = !$event->getId() ? 201 : 204;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new EventFormType(), $event);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em->flush($event);

            $response = new Response();
            $response->setStatusCode($statusCode);

            // set the `Location` header only when creating new resources
            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'acme_demo_user_get', array('id' => $event->getId()),
                        true // absolute
                    )
                );
            }

            return $response;
        }

        return $this->view($form, 400);
    }

    /**
     * @return EventService
     */
    protected  function getEventService()
    {
        return $this->get('eventService');
    }

    /**
     * Lists all Event entities.
     * Route (api/v1/events)
     */
    public function cgetAction()
    {
        $events = $this->getEventService()->getEvents();

        return array(
            'events' => DtoService::objectToDto($events, new EventDto()),
        );
    }

    /**
     * find one event by id
     * Route (api/v1/events/{id})
     */
    public function getAction($id)
    {
        $event = $this->getEventService()->getEvent($id);

        if (!$event instanceof Event) {
            throw new NotFoundHttpException('Event not found');
        }

        return array(
            'event' => DtoService::objectToDto($event, new EventDto()),
        );
    }

    public function postAction()
    {
        return $this->processForm(new Event());
    }
}
