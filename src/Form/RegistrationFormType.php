<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class RegistrationFormType to handle the RegistrationForm Entity.
 */
class RegistrationFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    // Method to build the form fields.
    $builder
      // Add a field for email.
      ->add('email')
      // Add a field to make user agree to terms.
      ->add('agreeTerms', CheckboxType::class, [
        'mapped' => false,
        'constraints' => [
          new IsTrue([
            'message' => 'You should agree to our terms.',
          ]),
        ],
      ])
      // Add a fied for password.
      ->add('plainPassword', PasswordType::class, [
        // Instead of being set onto the object directly,
        // this is read and encoded in the controller
        'mapped' => false,
        'attr' => ['autocomplete' => 'new-password'],
        'constraints' => [
        new NotBlank([
        'message' => 'Please enter a password',
        ]),
        new Length([
        'min' => 6,
        'minMessage' => 'Your password should be at least {{ limit }} characters',
        // max length allowed by Symfony for security reasons
        'max' => 4096,
        ]),
        ],
      ])
    ;
  }


  // Define a method to configure the default options for the form.
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
        'data_class' => User::class,
    ]);
  }
}
