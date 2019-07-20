<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuRender
 *
 * @ORM\Table(name="menu_render")
 * @ORM\Entity
 */
class MenuRender
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_menu_render", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMenuRender;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_rol", type="string", length=50, nullable=false)
     */
    private $nombreRol;

    public function getIdMenuRender(): ?int
    {
        return $this->idMenuRender;
    }

    public function getNombreRol(): ?string
    {
        return $this->nombreRol;
    }

    public function setNombreRol(?string $nombreRol): self
    {
        $this->nombreRol = $nombreRol;

        return $this;
    }


}
