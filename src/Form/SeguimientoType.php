<?php

namespace App\Form;

use App\Entity\Seguimiento;
use App\Entity\TipoCorreo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SeguimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaSeguimiento', DateType::class, [
                'label' => 'Fecha de Envío',
                'format' => 'ddMMMMyyyy',
            ])
            ->add('tipoCorreo', EntityType::class, [
                'class' => TipoCorreo::class,
                'choice_label' => 'nombreTipoCorreo',
                'placeholder' => '--Seleccione--',
                'label' => 'Tipo de Correo Electrónico',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seguimiento::class,
        ]);
    }
}