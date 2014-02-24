<?php
namespace Vputi\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Edit profile form type
 *
 * @package Vputi\UserBundle\Form\Type
 */
class CustomProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('surname');
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('birthDate');
        $builder->add('sex', 'choice', array(
            'choices'   => array('1' => 'Male', '0' => 'Female'),
        ));
        $builder->add('driver', 'vputi_driver');

        //@TODO: Remove on prod
//        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event){
//            $driver = $event->getForm()->getData()->getDriver();
//            $profile = $event->getForm()->getData();
//
//            if ($driver && !$driver->getProfile()) {
//                $driver->setProfile($profile);
//            }
//        });
    }

    public function getName()
    {
        return 'vputi_custom_profile';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vputi\UserBundle\Entity\Profile',
        ));
    }
}