<?php

namespace Dai\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('date', 'date')
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('image', new ImageType())
            
            ->add('category', 'entity', array(
              'class'    => 'DaiPortfolioBundle:Category',
              'property' => 'name',
              'multiple' => false,
              'required' => false
            ))
            ->add('published', 'checkbox', array('required' => false))

            // ->add('tags', 'entity', array(
            //     'class'    => 'DaiPortfolioBundle:Tag',
            //     'property' => 'name',
            //     'multiple' => true,
            //     'expanded' => false,
            //     'required' => false
            // ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dai\PortfolioBundle\Entity\Work'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dai_portfoliobundle_work';
    }
}
