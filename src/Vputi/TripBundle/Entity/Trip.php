<?php

namespace Vputi\TripBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trip
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vputi\TripBundle\Entity\TripRepository")
 */
class Trip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="departure", type="string", length=255)
     *
     * @Assert\NotBlank(groups={"create, update"})
     */
    private $departure;

    /**
     * @var string
     *
     * @ORM\Column(name="arrival", type="string", length=255)
     *
     * @Assert\NotBlank(groups={"create, update"})
     */
    private $arrival;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_departure", type="datetime")
     *
     * @Assert\NotBlank(groups={"create, update"})
     */
    private $timeDeparture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_arrival", type="datetime")
     *
     * @Assert\NotBlank(groups={"create, update"})
     */
    private $timeArrival;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="smallint")
     */
    private $count;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set departure
     *
     * @param string $departure
     * @return Trip
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return string 
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set arrival
     *
     * @param string $arrival
     * @return Trip
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get arrival
     *
     * @return string 
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Trip
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set timeDeparture
     *
     * @param \DateTime $timeDeparture
     * @return Trip
     */
    public function setTimeDeparture($timeDeparture)
    {
        $this->timeDeparture = $timeDeparture;

        return $this;
    }

    /**
     * Get timeDeparture
     *
     * @return \DateTime 
     */
    public function getTimeDeparture()
    {
        return $this->timeDeparture;
    }

    /**
     * Set timeArrival
     *
     * @param \DateTime $timeArrival
     * @return Trip
     */
    public function setTimeArrival($timeArrival)
    {
        $this->timeArrival = $timeArrival;

        return $this;
    }

    /**
     * Get timeArrival
     *
     * @return \DateTime 
     */
    public function getTimeArrival()
    {
        return $this->timeArrival;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Trip
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Trip
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
