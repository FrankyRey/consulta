<?php

namespace App\Form;

use App\Entity\Expediente;
use App\Entity\Documento;
use App\Entity\EstatusDocumento;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExpedienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idDocumento', EntityType::class, [
                'class' => Documento::class,
                'choice_label' => 'nombreDocumento',
                'placeholder' => '--Seleccione--',
                'label' => 'Nombre del Documento',
            ])
            ->add('idEstatusDocumento', EntityType::class, [
                'class' => EstatusDocumento::class,
                'choice_label' => 'nombreEstatusDocumento',
                'placeholder' => '--Seleccione--',
                'label' => 'Estatus del Documento',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expediente::class,
        ]);
    }
}