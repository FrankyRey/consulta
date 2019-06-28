<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConceptoPago
 *
 * @ORM\Table(name="concepto_pago")
 * @ORM\Entity
 */
class ConceptoPago
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_concepto_pago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConceptoPago;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_concepto_pago", type="string", length=60, nullable=false)
     */
    private $nombreConceptoPago;

    public function getIdConceptoPago(): ?int
    {
        return $this->idConceptoPago;
    }

    public function getNombreConceptoPago(): ?string
    {
        return $this->nombreConceptoPago;
    }

    public function setNombreConceptoPago(string $nombreConceptoPago): self
    {
        $this->nombreConceptoPago = $nombreConceptoPago;

        return $this;
    }


}