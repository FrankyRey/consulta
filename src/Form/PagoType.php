<?php

namespace App\Form;

use App\Entity\Pago;
use App\Entity\ConceptoPago;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mes')
            ->add('anio')
            ->add('cantidad', NumberType::class)
            ->add('fechaPago', DateType::class, [
                'label' => 'Fecha de Pago',
                'format' => 'ddMMMMyyyy',
            ])
            ->add('idConcepto', EntityType::class, [
                'class' => ConceptoPago::class,
                'choice_label' => 'nombreConceptoPago',
                'placeholder' => '--Seleccione--',
                'label' => 'Concepto',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }
}