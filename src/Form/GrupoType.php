<?php

namespace App\Form;

use App\Entity\Grupo;
use App\Entity\NivelAcademico;
use App\Entity\OfertaAcademica;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;

class GrupoType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('semestre')
            ->add('grupo')
            ->add('idNivelAcademico', EntityType::class, [
                'class' => NivelAcademico::class,
                'placeholder' => '--Seleccione--',
                'choice_label' => 'nombreNivelAcademico'
            ])
        ;

        $formModifier = function (FormInterface $form, NivelAcademico $nivelAcademico = null) {
            

            $ofertaAcademica = null === $nivelAcademico ? [] : $result = $this->em
                ->getRepository(OfertaAcademica::class)
                ->findBy([
                    'idNivelAcademico' => $nivelAcademico->getIdNivelAcademico()
                ]);

            $form->add('idOfertaAcademica', EntityType::class, [
                'class' => OfertaAcademica::class,
                'placeholder' => '--Seleccione--',
                'choices' => $ofertaAcademica,
                'choice_label' => 'nombreOfertaAcademica'
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getIdNivelAcademico());
            }
        );

        $builder->get('idNivelAcademico')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $idNivelAcademico = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $idNivelAcademico);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Grupo::class,
        ]);
    }
}
