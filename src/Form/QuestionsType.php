<?php

namespace App\Form;

use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class QuestionsType to handle the Questions entity.
 */
class QuestionsType extends AbstractType
{
  // Method to build the form fields.
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    // Add form fields for the Questions entity
    $builder
      // Add a field for the Question statement.
      ->add('Question')
      // Add a field for the option A.
      ->add('A')
      // Add a field for the option B.
      ->add('B')
      // Add a field for the option C.
      ->add('C')
      // Add a field for the option D.
      ->add('D')
      // Add a field for the coorect answer.
      ->add('correct')
      // Add a field foe the marks for that question.
      ->add('marks')
    ;
  }

  // Method to configure the default options for the form
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
    'data_class' => Questions::class,
    ]);
  }
}
