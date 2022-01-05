<?php

namespace App\Form;

use App\Entity\Devise;
use App\Entity\User;
use App\Repository\DeviseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('uuid',NumberType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 5,
                'max' => 5
            ]),
            'attr' => [
                'placeholder' => 'Entré un identifiant de 5 chiffres '
            ]
        ])
        ->add('nom', TextType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' => [
                'placeholder' => 'Votre nom'
            ]
        ])
        ->add('prenom', TextType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' => [
                'placeholder' => 'Votre prénom'
            ]
        ])

        ->add('email', EmailType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 2,
                'max' => 55
            ]),
            'attr' => [
                'placeholder' => 'Adresse email'
            ]
        ])

        ->add('phone', NumberType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => '+....'
            ]
        ])
        
         ->add('banque', TextType::class,[
            'label' => false,
         
        ])

        ->add('pays', CountryType::class,[
            'label' => false,
        ])

        ->add('ville' , TextType::class,[
            'label' => false,
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' => [
                'placeholder' => 'Ville'
            ]
        ])

        ->add('adresse' , TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Votre adresse'
            ]
        ])

        ->add('mydevise' , EntityType::class,[
            'class' => Devise::class,
            'label' => false,
            'expanded' => false,
            'multiple' => false,
            'query_builder' => function (DeviseRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.name', 'ASC');
            },
            'choice_label' => 'name'
        ])

        ->add('banque' , TextType::class,[
            'label' => false,
           
            "attr" => [
                "placeholder"=>"Choisissez la banque ou avez deja un compte"
            ]
        ])

        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
            'label' => 'Votre mot de passe',
            'required' => true,
            'first_options' => [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe.',
                    'class' => 'form-control signup-password'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmez votre mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre mot de passe.',
                    'class' => 'form-control signup-password'
                ]
            ]
        ])

        ->add('submit', SubmitType::class, [
            'label' => "S'inscrire maintenant",
            'attr' => [
                'class' => 'btn btn-primary w-100 theme-btn mx-auto'
            ]
        ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
