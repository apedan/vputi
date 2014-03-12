<?php

namespace Vputi\EventBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vputi\EventBundle\Dto\Event as EventDto;

/**
 * Event controller.
 *
 */
class ApiController extends Controller
{

    /**
     * Lists all Event entities.
     *
     * @Rest\View
     */
    public function getEventsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EventBundle:Event')->findAll();

        return array(
            'events' => $events,
        );
    }

    /**
     * Test Dto action
     *
     * @Rest\View
     */
    public function testAction()
    {
        $data = new EventDto();
        $data->id = 1;
        $data->title = 'tt';
        $data->description = 'dd';

        return $data;
    }
}
