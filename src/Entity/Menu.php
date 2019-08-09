<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_menu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="id_html", type="string", length=60, nullable=false)
     */
    private $idHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="label_html", type="string", length=100, nullable=false)
     */
    private $labelHtml;

    /**
     * @var string|null
     *
     * @ORM\Column(name="route", type="string", length=100, nullable=true)
     */
    private $route;

    /**
     * @var string|null
     *
     * @ORM\Column(name="icon", type="string", length=60, nullable=true)
     */
    private $icon;

    /**
     * @var bool
     *
     * @ORM\Column(name="child", type="boolean", nullable=false)
     */
    private $child = 0;

    /**
     * @var \Menu
     *
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent", referencedColumnName="id_menu")
     * })
     */
    private $parent;

    public function getIdMenu(): ?int
    {
        return $this->idMenu;
    }

    public function getIdHtml(): ?string
    {
        return $this->idHtml;
    }

    public function setIdHtml(?string $idHtml): self
    {
        $this->idHtml = $idHtml;

        return $this;
    }

    public function getLabelHtml(): ?string
    {
        return $this->labelHtml;
    }

    public function setLabelHtml(?string $labelHtml): self
    {
        $this->labelHtml = $labelHtml;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

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

    public function getParent(): ?Menu
    {
        return $this->parent;
    }

    public function setParent(?Menu $parent): self
    {
        $this->parent = $parent;

        return $this;
    }


}