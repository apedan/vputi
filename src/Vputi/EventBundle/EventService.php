<?php

namespace Vputi\EventBundle;

use Vputi\EventBundle\Entity\EventRepository;
use Vputi\EventBundle\Entity\Event;
use Vputi\EventBundle\Form\Type\EventFormType;

class EventService
{
    /**
     * @var Entity\EventRepository
     */
    private $eventRepository;

    function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getEvents()
    {
        return $this->eventRepository->findAll();
    }

    public function getEvent($id)
    {
        return $this->eventRepository->findOneBy(array('id' => $id));
    }
}
