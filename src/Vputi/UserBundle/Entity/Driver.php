<?php

namespace Vputi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vputi\UserBundle\Entity\Profile;

/**
 * Driver
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vputi\UserBundle\Entity\DriverRepository")
 */
class Driver
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
     * @var \DateTime
     *
     * @ORM\Column(name="licenseDate", type="date")
     */
    private $licenseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="licenseCategory", type="string", length=8)
     */
    private $licenseCategory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="experience", type="date")
     */
    private $experience;

    /**
     * @var Profile
     *
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="driver")
     */
    private $profile;

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
     * Set licenseDate
     *
     * @param \DateTime $licenseDate
     * @return Driver
     */
    public function setLicenseDate($licenseDate)
    {
        $this->licenseDate = $licenseDate;

        return $this;
    }

    /**
     * Get licenseDate
     *
     * @return \DateTime 
     */
    public function getLicenseDate()
    {
        return $this->licenseDate;
    }

    /**
     * Set licenseCategory
     *
     * @param string $licenseCategory
     * @return Driver
     */
    public function setLicenseCategory($licenseCategory)
    {
        $this->licenseCategory = $licenseCategory;

        return $this;
    }

    /**
     * Get licenseCategory
     *
     * @return string 
     */
    public function getLicenseCategory()
    {
        return $this->licenseCategory;
    }

    /**
     * Set experience
     *
     * @param \DateTime $experience
     * @return Driver
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return \DateTime 
     */
    public function getExperience()
    {
        return $this->experience;
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
