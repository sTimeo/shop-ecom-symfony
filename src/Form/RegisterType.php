<?php

namespace App\Form;

use App\Entity\User; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'votre prénom'
            ])
            ->add('lastname', TextType::class,[
                'label' => 'votre nom'
            ])
            ->add('email', EmailType::class,[
                'label' => 'votre email'
            ])
            ->add('password', PasswordType::class,[
                'label' => 'mdp'
            ])
            ->add('password_confirm', PasswordType::class,[
                'label' => 'confirmation du mdp',
                'mapped' => false
            ])
            ->add('submit', SubmitType::class,[
                'label' => "s'inscrire"
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
