<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CustomerType extends AbstractType{

  public function buildForm(FormBuilderInterface $builder, array $options){
    $builder
      ->add('firstName', TextType::class, array(
        'label'              => 'label.customer.firstname',
        'translation_domain' => 'labels'
      ))
      ->add('lastName', TextType::class, array(
        'label'              => 'label.customer.lastname',
        'translation_domain' => 'labels'
      ))
      ->add('email', EmailType::class, array(
        'label'              => 'label.customer.email',
        'translation_domain' => 'labels'
      ))
      ->add('groups', EntityType::class, array(
        'class'              => 'AppBundle:Group',
        'label'              => 'label.customer.groups',
        'translation_domain' => 'labels',
        'multiple'           => true,
        'expanded'           => true,
      ))
      ->add('observations', TextareaType::class, array(
        'label'              => 'label.customer.observations',
        'translation_domain' => 'labels',
      ));
  }

  public function configureOptions(OptionsResolver $resolver){
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Customer',
    ));
  }

  public function getBlockPrefix(){
    return 'appbundle_customer';
  }

}