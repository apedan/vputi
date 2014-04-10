<?php
namespace Vputi\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('phone');
        $builder->add('profile', 'vputi_custom_profile');
    }

    public function getName()
    {
        return 'vputi_user_registration';
    }
}