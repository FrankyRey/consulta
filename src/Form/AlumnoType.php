<?php

namespace App\Form;

use App\Entity\Alumno;
use App\Entity\NivelAcademico;
use App\Entity\OfertaAcademica;
use App\Entity\EstatusAlumno;
use App\Entity\Grupo;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;

class AlumnoType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
            ->add('idEstatusAlumno', EntityType::class, [
                'class' => EstatusAlumno::class,
                'choice_label' => 'nombreEstatusAlumno',
                'placeholder' => '--Seleccione--'
            ])
        ;

        $formAddGrupo = function (FormInterface $form, OfertaAcademica $ofertaAcademica = null) {            

            $grupos = null === $ofertaAcademica ? [] : $result = $this->em
                ->getRepository(Grupo::class)
                ->findBy([
                    'idNivelAcademico' => $ofertaAcademica->getIdNivelAcademico(),
                    'idOfertaAcademica' => $ofertaAcademica->getIdOfertaAcademica(),
                ]);

            $form->add('idGrupo', EntityType::class, [
                'class' => Grupo::class,
                'placeholder' => '--Seleccione--',
                'choices' => $grupos,
                'choice_label' => 'selectLabel',
                'required' => false
            ]);
        };

        $formModifier = function (FormInterface $form, NivelAcademico $nivelAcademico = null) use ($formAddGrupo){            

            $ofertaAcademica = null === $nivelAcademico ? [] : $result = $this->em
                ->getRepository(OfertaAcademica::class)
                ->findBy([
                    'idNivelAcademico' => $nivelAcademico->getIdNivelAcademico()
                ]);

            $form->add('idOfertaAcademica', EntityType::class, [
                'class' => OfertaAcademica::class,
                'placeholder' => '--Seleccione--',
                'choice_label' => 'nombreOfertaAcademica',
                'choices' => $ofertaAcademica,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier,$formAddGrupo) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getIdNivelAcademico());
                $formAddGrupo($event->getForm(), null);
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($formModifier, $formAddGrupo) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $data = $event->getData();
                
                if(isset($data['idNivelAcademico'])){
                    $nivelAcademico = $this->em
                        ->getRepository(NivelAcademico::class)
                        ->findOneBy([
                            'idNivelAcademico' => $data['idNivelAcademico']
                    ]);
                    $formModifier($event->getForm(), $nivelAcademico);
                }
                else{
                    if(isset($data['idOfertaAcademica'])){
                        $ofertaAcademica = $this->em
                            ->getRepository(OfertaAcademica::class)
                            ->findOneBy([
                                'idOfertaAcademica' => $data['idOfertaAcademica']
                        ]);
                        $formAddGrupo($event->getForm(), $ofertaAcademica);
                    }
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alumno::class,
        ]);
    }
}
