<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuMenuRender
 *
 * @ORM\Table(name="menu_menu_render")
 * @ORM\Entity
 */
class MenuMenuRender
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_menu_menu_render", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMenuMenuRender;

    /**
     * @var \Menu
     *
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id_menu", referencedColumnName="id_menu")
     * })
     * @ORM\OrderBy({"child" = "ASC"})
     */
    private $menuIdMenu;

    /**
     * @var \MenuRender
     *
     * @ORM\ManyToOne(targetEntity="MenuRender")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id_menu_render", referencedColumnName="id_menu_render")
     * })
     */
    private $menuIdMenuRender;

    /**
     * @var bool
     *
     * @ORM\Column(name="child", type="boolean", nullable=false)
     */
    private $child = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    public function getIdMenuMenuRender(): ?int
    {
        return $this->idMenuMenuRender;
    }

    public function getMenuIdMenu(): ?Menu
    {
        return $this->menuIdMenu;
    }

    public function setMenuIdMenu(?Menu $menuIdMenu): self
    {
        $this->menuIdMenu = $menuIdMenu;

        return $this;
    }

    public function getMenuIdMenuRender(): ?MenuRender
    {
        return $this->menuIdMenuRender;
    }

    public function setMenuIdMenuRender(?MenuRender $menuIdMenuRender): self
    {
        $this->menuIdMenuRender = $menuIdMenuRender;

        return $this;
    }

    public function getChild(): ?bool
    {
        return $this->child;
    }

    public function setChild(?bool $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }


}