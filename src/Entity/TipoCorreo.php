<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoCorreo
 *
 * @ORM\Table(name="tipo_correo")
 * @ORM\Entity
 */
class TipoCorreo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tipo_correo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo_correo", type="string", length=50, nullable=false)
     */
    private $nombreTipoCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=50, nullable=true)
     */
    private $template;

    public function getIdTipoCorreo(): ?int
    {
        return $this->idTipoCorreo;
    }

    public function getNombreTipoCorreo(): ?string
    {
        return $this->nombreTipoCorreo;
    }

    public function setNombreTipoCorreo(string $nombreTipoCorreo): self
    {
        $this->nombreTipoCorreo = $nombreTipoCorreo;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }


}
