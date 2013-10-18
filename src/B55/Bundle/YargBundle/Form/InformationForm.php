<?php
namespace B55\Bundle\YargBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InformationForm extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('title', 'text', array('label' => 'yarg.cv.category.information.title'));
    $builder->add('value', 'textarea', array('label' => 'yarg.cv.category.information.value'));
  }

  /**
   * {@inheritdoc}
   */
  public function getName(){
    return 'Information';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Information',
    );
  }
}


