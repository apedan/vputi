<?php

namespace Vputi\RestApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vputi\RestApiBundle\Dto\Event as EventDto;
use Vputi\RestApiBundle\Dto\DtoService as DtoService;

/**
 * Rest API Event controller.
 * Route (api/event)
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     * Route (api/event/events)
     * @Rest\View
     */
    public function getEventsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('EventBundle:Event')->findAll();

        return array(
            'events' => DtoService::objectToDto($events, new EventDto()),
        );
    }
}
