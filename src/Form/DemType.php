<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class DemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom & Prénom',
                    'class' => 'form-control'
                ]
            ])
            ->add('type' , ChoiceType::class ,[
                'label' => false,
                'choices'  => [
                    'Choisir ici' => null,
                    'Demande de prêt' => "Demande de prêt",
                    'Don' => "Don",
                ],
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control'
                ]
            ])
             ->add('numero', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Numero',
                    'class' => 'form-control'
                ]
            ])
             ->add('pays', CountryType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Pays',
                    'class' => 'form-control'
                ]
            ])
            ->add('montant', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Montant',
                    'class' => 'form-control'
                ]
            ])
            ->add('devise' , ChoiceType::class ,[
                'label' => false,
                'choices'  => [
                    'Choisir ici' => null,
                    'Euro' => "Euro",
                    'Dollar' => "Dollar",
                ],
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('dure' , TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Durée',
                    'class' => 'form-control'
                ]
            ])
            
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Message',
                    'class' => 'form-control'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn w-100 btn-primary py-2 mt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
