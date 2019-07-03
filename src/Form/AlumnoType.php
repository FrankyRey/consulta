<?php

namespace App\Form;

use App\Entity\Alumno;
use App\Entity\NivelAcademico;
use App\Entity\OfertaAcademica;
use App\Entity\EstatusAlumno;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricula')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('nombre')
            ->add('curp')
            ->add('edad')
            ->add('fechaNacimiento', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => [
                    'class' => 'datepicker-here',
                    'data-language' => 'es',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-auto-close' => 'true',
                ],
            ])
            ->add('sexo')
            ->add('correoElectronico')
            ->add('telefonoFijo')
            ->add('telefonoCelular')
            ->add('fechaAlta', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => [
                    'class' => 'datepicker-here',
                    'data-language' => 'es',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-auto-close' => 'true',
                ],
            ])
            ->add('idNivelAcademico', EntityType::class, [
                'class' => NivelAcademico::class,
                'choice_label' => 'nombreNivelAcademico',
                'placeholder' => '--Seleccione--'
            ])
            ->add('idOfertaAcademica', EntityType::class, [
                'class' => OfertaAcademica::class,
                'choice_label' => 'nombreOfertaAcademica',
                'placeholder' => '--Seleccione--'
            ])
            ->add('idEstatusAlumno', EntityType::class, [
                'class' => EstatusAlumno::class,
                'choice_label' => 'nombreEstatusAlumno',
                'placeholder' => '--Seleccione--'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alumno::class,
        ]);
    }
}
