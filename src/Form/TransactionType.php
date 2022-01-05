<?php

namespace App\Form;

use App\Entity\Banque;
use App\Entity\Transaction;
use App\Repository\BanqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('bankName' , TextType::class,[
                'label' => false,
            ])


            ->add('nom', TextType::class, [
                'label' => false
            ])
            ->add('prenom', TextType::class, [
                'label' => false
            ])
            ->add('montant',IntegerType::class,[
                "label" => false
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Etape suivante",
                'attr' => [
                    'class' => 'btn app-btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
