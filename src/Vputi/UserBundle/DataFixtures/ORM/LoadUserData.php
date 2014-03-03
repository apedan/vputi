<?php

namespace Vputi\UserBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Vputi\UserBundle\Entity\User;
use Vputi\UserBundle\Entity\Driver;
use Vputi\UserBundle\Entity\Profile;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    protected $userManager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->userManager = $container->get('fos_user.user_manager');
    }

    public function getOrder()
    {
        return 5;
    }

    public function load(ObjectManager $manager)
    {
        $apedan = new User();
        $apedan->setUsername('apedan');
        $apedan->setEmail('a.pedan@gmail.com');
        $apedan->setPlainPassword('1723104');
        $apedan->setEnabled(true);
        $apedan->addRole('ROLE_ADMIN');
        $apedan->setPhone('1723104');

        $this->userManager->updateUser($apedan);

        $apedanProfile = new Profile();
        $apedanProfile->setSurname('Педан');
        $apedanProfile->setFirstName('Александр');
        $apedanProfile->setLastName('Владимирович');
        $apedanProfile->setBirthDate(new \DateTime('11-04-1987'));
        $apedanProfile->setSex(1);
        $apedanProfile->setUser($apedan);

        $manager->persist($apedanProfile);

        $vasya = new User();
        $vasya->setUsername('vasya');
        $vasya->setEmail('vasya@gmail.com');
        $vasya->setPlainPassword('1723104');
        $vasya->setEnabled(true);
        $vasya->addRole('ROLE_USER');
        $vasya->setPhone('1723104');

        $this->userManager->updateUser($vasya);

        $driver = new Driver();
        $driver->setLicenseCategory('BC');
        $driver->setLicenseDate(new \DateTime('20-09-2010'));
        $driver->setExperience(new \DateTime('15-10-2010'));

        $manager->persist($driver);

        $vasyaProfile = new Profile();
        $vasyaProfile->setSurname('Васильев');
        $vasyaProfile->setFirstName('Василий');
        $vasyaProfile->setLastName('Васильевич');
        $vasyaProfile->setBirthDate(new \DateTime('21-06-1990'));
        $vasyaProfile->setSex(1);
        $vasyaProfile->setUser($vasya);
        $vasyaProfile->setDriver($driver);

        $manager->persist($vasyaProfile);

        $manager->flush();
    }
}