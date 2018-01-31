<?php

namespace App\Form;

use App\Entity\Equipamento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class EquipamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patrimonio')
            ->add('macaddress')
            ->add('naopatrimoniado')
            ->add('local')
            ->add('rede')
            ->add('ip')
            ->add('descricaosempatrimonio')    
            ->add('vencimento',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])    

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Equipamento::class,
        ]);
    }
}
