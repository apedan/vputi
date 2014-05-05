<?php

namespace Vputi\TripBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TripFormType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departure')
            ->add('arrival')
            ->add('price')
            ->add('timeDeparture')
            ->add('timeArrival')
            ->add('count')
            ->add('description')
            ->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'ui labeled button teal')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vputi\TripBundle\Entity\Trip',
//            'csrf_protection'   => false, //for REST API
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vputi_trip';
    }
}
