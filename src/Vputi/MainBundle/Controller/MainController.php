<?php

namespace Vputi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserInterface;

class MainController extends Controller
{
    public function homeAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            $user = false;
        }

        return $this->render('MainBundle:Main:home.html.twig', array('user' => $user));
    }
}
