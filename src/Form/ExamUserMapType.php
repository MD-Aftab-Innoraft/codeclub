<?php

namespace App\Form;

use App\Entity\Exams;
use App\Entity\ExamUserMap;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ExamUserMapType to handle the ExamUserMap Entity.
 */
class ExamUserMapType extends AbstractType
{
  // Method to build the form fields.
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    // Add form fields for the ExamUserMap entity
    $builder
      // Add a field for the user id.
      ->add('userId', EntityType::class, [
        'class' => User::class,
        'choice_label' => 'id',
      ])
      // Add a field for the exam id.
      ->add('examId', EntityType::class, [
        'class' => Exams::class,
        'choice_label' => 'id',
      ])
    ;
  }

  // Method to configure the default options for the form
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => ExamUserMap::class,
    ]);
  }
}
