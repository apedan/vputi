<?php

namespace Vputi\UserBundle\Entity;

use Vputi\UserBundle\Entity\MainUser as MainUser;
use Vputi\UserBundle\Entity\Profile as Profile;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Entity()
 */
class User extends MainUser
{
    /**
     * @var Driver
     *
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     */
    protected $profile;

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
     * @param Profile $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

}
