<?php
// src/EventSubscriber/KnpMenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Menu;

class KnpMenuBuilderSubscriber extends AbstractController implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_SIDEBAR_SETUP_KNP_MENU => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $user = $this->getUser();

        $elementos = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findBy([
                'idMenuRender' => 2
            ], [
                'child' => 'ASC',
                'orden' => 'ASC'
            ]);

        $menu = $event->getMenu();

        $menu->addChild('MainNavigationMenuItem', [
       	    'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');

        foreach ($elementos as $elemento)
        {
            if($elemento->getChild())
            {
                $menu[$elemento->getParent()->getIdHtml()]->addChild($elemento->getIdHtml(), [
                    'route' => $elemento->getRoute(),
                    'label' => $elemento->getLabelHtml(),
                    'childOptions' => $event->getChildOptions()
                ]);
            }
            else
            {
                $menu ->addChild($elemento->getIdHtml(), [
                    'route' => $elemento->getRoute() ? $elemento->getRoute():[],
                    'label' => $elemento->getLabelHtml(),
                    'childOptions' => $event->getChildOptions()
                ])->setLabelAttribute('icon', $elemento->getIcon());
            }
        }
    }
}