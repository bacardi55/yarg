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
    $builder->add(
      'description',
      'text',
      array('label' => 'yarg.cv.description', 'required' => false)
    );
    $builder->add(
      'catch',
      'text',
      array('label' => 'yarg.cv.catch', 'required' => false)
    );
    $builder->add(
      'published',
      'checkbox',
      array(
        'label' => 'yarg.cv.is_public',
        'required' => false,
      )
    );
    $builder->add(
      'searchable',
      'checkbox',
      array(
        'label' => 'yarg.cv.is_searchable',
        'required' => false,
      )
    );
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
