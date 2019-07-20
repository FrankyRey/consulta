<?php

namespace App\Form;

use App\Entity\MenuRender;
use App\Entity\Menu;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idHtml')
            ->add('labelHtml')
            ->add('route')
            ->add('icon')
            ->add('child')
            ->add('parent', EntityType::class, [
                'class' => Menu::class,
                'placeholder' => '--Seleccione--',
                'choice_label' => 'idHtml',
                'required' => false
            ])
            ->add('idMenuRender', EntityType::class, [
                'class' => MenuRender::class,
                'placeholder' => '--Seleccione--',
                'choice_label' => 'nombreRol',
            ])
            ->add('orden')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
