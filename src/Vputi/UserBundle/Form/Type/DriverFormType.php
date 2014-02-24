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
class DriverFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('licenseDate');
        $builder->add('licenseCategory');
        $builder->add('experience');
    }

    public function getName()
    {
        return 'vputi_driver';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vputi\UserBundle\Entity\Driver',
        ));
    }
}