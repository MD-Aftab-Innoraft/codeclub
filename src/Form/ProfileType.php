<?php

namespace App\Form;

use App\Entity\Profile;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProfileType to handle the Profile entity.
 */
class ProfileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      // Add a field for the Fullname.
      ->add('Fullname')
      // Add a field for the email.
      ->add('email')
      // Add a field for the phone.
      ->add('phone')
      // Add a field for the Date-Of-Birth.
      ->add('DOB', null, [
        'widget' => 'single_text',
      ])
      // Add a field for the Age.
      ->add('Age')
      // Add a field for the X'th standard marks.
      ->add('Xmarks')
      // Add a field for the XII'th standard marks.
      ->add('XIImarks')
      // Add a field for the resume.
      ->add('resume')
      // Add a field for the user.
      ->add('user', EntityType::class, [
        'class' => User::class,
        'choice_label' => 'id',
      ])
    ;
  }

  // Method to configure the default options for the form
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
        'data_class' => Profile::class,
    ]);
  }
}
