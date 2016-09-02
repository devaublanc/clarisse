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
            ->add('width', 'text')
            ->add('height', 'text')
            ->add('image', new ImageType(), array('required' => false))
            ->add('position', 'integer')

            ->add('category', 'entity', array(
              'class'    => 'DaiPortfolioBundle:Category',
              'property' => 'name',
              'multiple' => false,
              'required' => false
            ))
            ->add('available', 'checkbox', array('required' => false))
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
