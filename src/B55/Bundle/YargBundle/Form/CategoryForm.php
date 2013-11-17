<?php
namespace B55\Bundle\YargBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryForm extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name', 'text', array('label' => 'yarg.my_yarg.cv.category.name'));
  }

  /**
   * {@inheritdoc}
   */
  public function getName(){
    return 'Category';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Category',
    );
  }
}

