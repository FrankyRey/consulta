<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\OfertaAcademica;

class MenuBuilderSubscriber extends AbstractController implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_SIDEBAR_SETUP_MENU => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $licenciaturasO = $this->getDoctrine()
            ->getRepository(OfertaAcademica::class)
            ->findBy([
                'idNivelAcademico' => 1
            ]);

        $maestriasO = $this->getDoctrine()
            ->getRepository(OfertaAcademica::class)
            ->findBy([
                'idNivelAcademico' => 2
            ]);

        $home = new MenuItemModel('home', 'Inicio', 'home', [], 'fas fa-home');
        $alumno = new MenuItemModel('alumno', 'Alumnos', 'alumno_index', [], 'fas fa-user-graduate');
        $inscritos = new MenuItemModel('inscritos', 'Alumnos Inscritos', [], [], 'fas fa-list-ul');
        $expediente = new MenuItemModel('expediente', 'Expedientes', 'expediente_index', [], 'far fa-folder-open');
        $seguimiento = new MenuItemModel('seguimiento', 'Seguimiento', 'seguimiento_index', [], 'far fa-paper-plane');
        $pagos = new MenuItemModel('pagos', 'Pagos', 'pagos_index', [], 'fas fa-dollar-sign');
        $paypal = new MenuItemModel('paypal', 'Pagar PayPal', 'paypal', [], 'fab fa-paypal');
        $catalogos = new MenuItemModel('catalogos', 'Catálogos', [], [], 'fas fa-cogs');
        $maestrias = new MenuItemModel('maestrias', 'Maestrías', [], []);
        $licenciaturas = new MenuItemModel('licenciaturas', 'Licenciaturas', [], []);
        
        if($licenciaturasO)
        {
            if($maestriasO)
            {
                $inscritos->addChild($maestrias)->addChild($licenciaturas);
            }
            else
            {
                $inscritos->addChild($licenciaturas);
            }
        }
        else
        {
            if($maestriasO)
            {
                $inscritos->addChild($maestrias);
            }
        }

        foreach ($maestriasO as $mas)
        {
            $maestrias->addChild(
                new MenuItemModel($mas->getIdOfertaAcademica().'mas', $mas->getNombreOfertaAcademica(), 'inscritos', ['idOfertaAcademica' => $mas->getIdOfertaAcademica()])
            );
        }

        foreach ($licenciaturasO as $lic)
        {
            $licenciaturas->addChild(
                new MenuItemModel($lic->getIdOfertaAcademica().'lic', $lic->getNombreOfertaAcademica(), 'inscritos', ['idOfertaAcademica' => $lic->getIdOfertaAcademica()])
            );
        }

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
        )->addChild(
            new MenuItemModel('estatusAlumno', 'Estatus del Alumno', 'estatus_alumno_index', [])
        )
        ;
        
        $event->addItem($home);
        $event->addItem($alumno);
        $event->addItem($inscritos);
        $event->addItem($expediente);
        $event->addItem($seguimiento);
        $event->addItem($pagos);
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