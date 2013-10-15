<?php
namespace B55\Bundle\YargBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CvForm extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('title', 'text', array('label' => 'yarg.cv.title'));
    $builder->add('description', 'text', array('label' => 'yarg.cv.description'));
    $builder->add('catch', 'text', array('label' => 'yarg.cv.catch'));
  }

  /**
   * {@inheritdoc}
   */
  public function getName(){
    return 'Cv';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Cv',
    );
  }
}
