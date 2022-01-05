<?php

namespace App\Form;

use App\Entity\Hackcompte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HackcompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifiant', TextType::class,[
                "label" => false
            ])
            ->add('pass', PasswordType::class,[
                "label" => false
            ])
            ->add('rib', TextType::class,[
                "label" => false
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Transféré maintenant",
                'attr' => [
                    'class' => 'btn app-btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hackcompte::class,
        ]);
    }
}
