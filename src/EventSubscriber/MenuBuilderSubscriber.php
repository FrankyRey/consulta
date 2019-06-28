<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_SIDEBAR_SETUP_MENU => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $home = new MenuItemModel('home', 'Inicio', 'home', [], 'fas fa-home');
        $alumno = new MenuItemModel('alumno', 'Alumnos', 'alumno_index', [], 'fas fa-user-graduate');
        $expediente = new MenuItemModel('expediente', 'Expedientes', 'expediente_index', [], 'far fa-folder-open');
        $seguimiento = new MenuItemModel('seguimiento', 'Seguimiento', 'seguimiento_index', [], 'far fa-paper-plane');
        $paypal = new MenuItemModel('paypal', 'Pagar PayPal', 'paypal', [], 'fab fa-paypal');
        $catalogos = new MenuItemModel('catalogos', 'Catálogos', [], [], 'fas fa-cogs');
    
        $catalogos->addChild(
            new MenuItemModel('nivelAcademico', 'Niveles Académicos', 'nivel_academico_index', [])
        )->addChild(
            new MenuItemModel('ofertaAcademica', 'Oferta Académica', 'oferta_academica_index', [])
        )->addChild(
            new MenuItemModel('tipoCorreo', 'Tipos de Correo', 'tipo_correo_index', [])
        )->addChild(
            new MenuItemModel('documento', 'Documentos', 'documento_index', [])
        )->addChild(
            new MenuItemModel('estatusDocumento', 'Estatus de Documentos', 'estatus_documento_index', [])
        )->addChild(
            new MenuItemModel('conceptoPago', 'Conceptos de Pago', 'concepto_pago_index', [])
        )
        ;
        
        $event->addItem($home);
        $event->addItem($alumno);
        $event->addItem($expediente);
        $event->addItem($seguimiento);
        $event->addItem($paypal);
        $event->addItem($catalogos);

        $this->activateByRoute(
            $event->getRequest()->get('_route'),
            $event->getItems()
        );
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     */
    protected function activateByRoute($route, $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }
}