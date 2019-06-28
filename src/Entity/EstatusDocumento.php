<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstatusDocumento
 *
 * @ORM\Table(name="estatus_documento")
 * @ORM\Entity
 */
class EstatusDocumento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_estatus_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstatusDocumento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_estatus_documento", type="string", length=50, nullable=true)
     */
    private $nombreEstatusDocumento;

    public function getIdEstatusDocumento(): ?int
    {
        return $this->idEstatusDocumento;
    }

    public function getNombreEstatusDocumento(): ?string
    {
        return $this->nombreEstatusDocumento;
    }

    public function setNombreEstatusDocumento(?string $nombreEstatusDocumento): self
    {
        $this->nombreEstatusDocumento = $nombreEstatusDocumento;

        return $this;
    }


}
