<?php
// src/OC/PlatformBundle/Form/AdvertEditType.php

namespace Dai\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class WorkEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'dai_portfoliobundle_work_edit';
  }

  public function getParent()
  {
    return new WorkType();
  }
}