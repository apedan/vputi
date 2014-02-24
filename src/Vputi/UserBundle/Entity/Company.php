<?php

namespace Vputi\UserBundle\Entity;

use Vputi\UserBundle\Entity\MainUser as MainUser;
use Vputi\UserBundle\Entity\Driver as Driver;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Entity()
 */
class Company extends MainUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var Driver
     *
     * @ORM\OneToMany(targetEntity="Driver", mappedBy="user")
     */
    protected $drivers;

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
     * Set name
     *
     * @param string $name
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
