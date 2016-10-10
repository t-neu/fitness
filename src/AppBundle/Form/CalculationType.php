<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CalculationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('age', ChoiceType::class, array(
                'choices'  => array(
                    'age' => range(18,100),
                ),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                'attr' => array('class' => 'form-control'),
            ))
            ->add('weight', ChoiceType::class, array(
                'choices'  => array(
                    'age' => range(85,400),
                ),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                'attr' => array('class' => 'form-control'),
            ))
            ->add('feet', ChoiceType::class, array(
                'choices'  => array(
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                ),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('inches', ChoiceType::class, array(
                'choices'  => array(
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                ),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('sex', ChoiceType::class, array(
                'choices'  => array(
                    'Male' => 1,
                    'Female' => 0,
                ),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('activity')         
                        
            ;
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Calculation'
        ));
    }
}
