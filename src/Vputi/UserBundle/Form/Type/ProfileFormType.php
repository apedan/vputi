<?php
namespace Vputi\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * Edit user profile, extends Fos profile form
 *
 * @package Vputi\UserBundle\Form\Type
 */
class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('profile', 'vputi_custom_profile');
    }

    public function getName()
    {
        return 'vputi_user_profile';
    }
}