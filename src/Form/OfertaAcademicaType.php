<?php

namespace App\Form;

use App\Entity\OfertaAcademica;
use App\Entity\NivelAcademico;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OfertaAcademicaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreOfertaAcademica')
            ->add('idNivelAcademico',EntityType::class,[
                'class' => NivelAcademico::class,
                'choice_label' => 'nombreNivelAcademico',
                'placeholder' => '--Seleccione un nivel--',
                'label' => 'Nivel Académico',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OfertaAcademica::class,
        ]);
    }
}
