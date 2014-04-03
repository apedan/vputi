<?php

namespace Vputi\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventFormType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('startDate')
            ->add('endDate')
            ->add('departure')
            ->add('description')
            ->add('maxCount')
            ->add('locale', 'choice', array(
                'choices' => array(
                    'ru' => 'Russian',
                    'en' => 'English',
                    'ua' => 'Ukrainian',
                ),
                'required'    => true,
            ))
            ->add('submit', 'submit', array('label' => 'Create'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vputi\EventBundle\Entity\Event',
            'csrf_protection'   => false, //for REST API
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vputi_event';
    }
}
