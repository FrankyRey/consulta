<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="documento")
 * @ORM\Entity
 */
class Documento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_codumento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCodumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento", type="string", length=100, nullable=false)
     */
    private $nombreDocumento;

    public function getIdCodumento(): ?int
    {
        return $this->idCodumento;
    }

    public function getNombreDocumento(): ?string
    {
        return $this->nombreDocumento;
    }

    public function setNombreDocumento(string $nombreDocumento): self
    {
        $this->nombreDocumento = $nombreDocumento;

        return $this;
    }


}
