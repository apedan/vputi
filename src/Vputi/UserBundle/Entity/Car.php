<?php

namespace Vputi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vputi\UserBundle\Entity\Driver;

/**
 * Car
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vputi\UserBundle\Entity\CarRepository")
 */
class Car
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
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="smallint")
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="maintenance", type="date")
     */
    private $maintenance;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="smallint")
     */
    private $seats;

    /**
     * @var Driver
     *
     * @ORM\ManyToOne(targetEntity="Driver", inversedBy="driver")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver;


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
     * Set model
     *
     * @param string $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set maintenance
     *
     * @param \DateTime $maintenance
     * @return Car
     */
    public function setMaintenance($maintenance)
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    /**
     * Get maintenance
     *
     * @return \DateTime 
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return Car
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer 
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param Driver $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
