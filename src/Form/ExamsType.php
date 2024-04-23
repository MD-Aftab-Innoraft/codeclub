<?php

namespace App\Form;

use App\Entity\Exams;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ExamsType to handle the Exams entity.
 */
class ExamsType extends AbstractType
{
  // Method to build the form fields.
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    // Add form fields for the Exams entity.
    $builder
      ->add('Title')
      // Configure the StartTime field to use a single text input widget.
      ->add('StartTime', null, [
        'widget' => 'single_text',
      ])
      // Configure the EndTime field to use a single text input widget.
      ->add('EndTime', null, [
        'widget' => 'single_text',
      ])
      // Add a field for the duration of the exam.
      ->add('Duration')
      // Add a field for the total marks of the exam.
      ->add('TotalMarks')
      // Add a field for the number of questions in the exam.
      ->add('NoOfQuestions')
      // Add a field for selecting a user (userid) using EntityType with User entities.
      ->add('userid', EntityType::class, [
        'class' => User::class,
        'choice_label' => 'id',
      ])
    ;
  }

  // Method to configure the default options for the form.
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Exams::class,
    ]);
  }
}
