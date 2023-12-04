<?php

namespace App\Form;

use App\Entity\User; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Prénom',
               'required' => false,

               'constraints' => [
                new Assert\NotBlank(['message' => 'tous les champs sont obligatoires'])
            ]


            
            ])
            ->add('lastname', TextType::class,[

                'label' => 'Nom',
                'required' => false,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'tous les champs sont obligatoires'])

                ]
    


            ])
            ->add('email', EmailType::class,[
                'label' => 'Email',
                'required' => false,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'tous les champs sont obligatoires'])

                ]
                
       
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe doivent être identique',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => false,

                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot passe'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'tous les champs sont obligatoires'])

                ]
    
            
                ])
         
            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire"
            ])

            ->add('birthdate', BirthdayType::class , [
                'required' => false,
                'format' => 'dd-MM-yyyy',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'tous les champs sont obligatoires'])

                ]
            ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
