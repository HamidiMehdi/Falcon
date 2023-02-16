<?php

namespace App\UserInterface\Form\Security;

use App\Infrastructure\Validator\UniqueEmail;
use App\UserInterface\DataTransferObject\Security\Registration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                    new UniqueEmail()
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe'
                ],
                'invalid_message' => 'La confirmation doit être similaire au mot de passe',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8, 'minMessage' => 'Votre mot de passe doit contenir au minimum 8 caractères.'])
                ]
            ])
            ->add('acceptTermsOfUse', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue(),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Registration::class);
    }

}