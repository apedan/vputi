<?php

namespace Vputi\TripBundle;

use Vputi\TripBundle\Entity\TripRepository;
use Vputi\TripBundle\Entity\Trip;
use Vputi\TripBundle\Form\Type\TripFormType;

class TripService
{
    /**
     * @var Entity\TripRepository
     */
    private $tripRepository;

    function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function getTrips()
    {
        return $this->tripRepository->findAll();
    }

    public function getTrip($id)
    {
        return $this->tripRepository->findOneBy(array('id' => $id));
    }
}
