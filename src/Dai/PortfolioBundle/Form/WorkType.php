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
            ->add('published', 'checkbox', array('required' => false))
            ->add('image',      new ImageType()) // Ajoutez cette ligne
            ->add('tags', 'entity', array(
                'class'    => 'DaiPortfolioBundle:Tag',
                'property' => 'name',
                'multiple' => true,
                'expanded' => false
            ))
            ->add('save', 'submit')
        ;

        // ->add('tags', 'collection', array(
        //     'type'         => new TagType(),
        //     'allow_add'    => true,
        //     'allow_delete' => true
        // ))
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
