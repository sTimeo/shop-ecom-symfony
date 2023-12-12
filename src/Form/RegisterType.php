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
               'attr' => ['placeholder' => 'Prénom'],
               'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/u',
                    'message' => "Le nom de famille ne peut contenir que des lettres et des espaces.",
                ]),
                new Assert\NotBlank([
                    'message' => "Champ vide",
                ])
            ]
            
            
            ])
            ->add('lastname', TextType::class,[

                'label' => 'Nom',
                'required' => false,
                'attr' => ['placeholder' => 'Nom'],
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/u',
                        'message' => "Le nom de famille ne peut contenir que des lettres et des espaces.",
                    ]),
                    new Assert\NotBlank([
                        'message' => "Champ vide",
                    ])
                ]

    


            ])
            ->add('email', EmailType::class,[
                'label' => 'Email',
                'required' => false,
                'attr' => ['placeholder' => 'Email'],

                
       
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => false,
                
                'first_options' => [
                    'label' => ' ',
                    'attr' => ['placeholder' => 'Mot de passe'],
                ],
                'second_options' => [
                    'label' => ' ',
                    'attr' => ['placeholder' => 'Confirmer le mot de passe'],
                ],
                ])
         
            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire"
            ])

            ->add('birthdate', BirthdayType::class , [
                'required' => false,
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'day' => 'Jour',
                    'month' => 'Mois',
                    'year' => 'Année',
                ],

            ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
