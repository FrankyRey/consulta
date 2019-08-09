<?php

namespace App\Form;

use App\Entity\MenuMenuRender;
use App\Entity\Menu;
use App\Entity\MenuRender;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuMenuRenderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menuIdMenuRender', EntityType::class, [
                'class' => MenuRender::class,
                'label' => 'Asignar al menú:',
                'placeholder' => '--Seleccione--',
                'choice_label' => 'nombreRol',
            ])
            ->add('menuIdMenu', EntityType::class, [
                'class' => Menu::class,
                'label' => 'Pantalla',
                'placeholder' => '--Seleccione--',
                'choice_label' => 'labelHtml',
            ])
            ->add('child')
            ->add('orden')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MenuMenuRender::class,
        ]);
    }
}
