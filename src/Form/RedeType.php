<?php

namespace App\Form;

use App\Entity\Rede;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RedeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('iprede')
            ->add('cidr',ChoiceType::class,[
                'choices' => [
                    19 => 19,
                    21 => 21,
                    22 => 22,
                    23 => 23,
                    24 => 24,
                    25 => 25,
                    26 => 26,
                    27 => 27,
                    28 => 28,
                    29 => 29,
                    30 => 30,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Rede::class,
        ]);
    }
}
