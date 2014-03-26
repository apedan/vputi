<?php

namespace Vputi\EventBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vputi\EventBundle\Dto\Event as EventDto;
use Vputi\EventBundle\Dto\DtoService as DtoService;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

use Vputi\EventBundle\Entity\Event;

/**
 * Rest API Event controller.
 * Route (api/event)
 */
class ApiController extends Controller
{

    /**
     * Lists all Event entities.
     * Route (api/events/all)
     * @Rest\View
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('EventBundle:Event')->findAll();

        return array(
            'events' => DtoService::objectToDto($events, new EventDto()),
        );
    }

    /**
     * @Rest\View
     * @ParamConverter("event", converter="fos_rest.request_body")
     */
    public function putEventAction(Event $post)
    {
        // ...
    }
}
