<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo", indexes={@ORM\Index(name="fk_grupo_oferta_academica1_idx", columns={"id_oferta_academica"}), @ORM\Index(name="fk_grupo_nivel_academico1_idx", columns={"id_nivel_academico"})})
 * @ORM\Entity
 */
class Grupo
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_grupo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupo;

    /**
     * @var int
     *
     * @ORM\Column(name="semestre", type="integer", nullable=false)
     */
    private $semestre;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=1, nullable=false)
     */
    private $grupo;

    /**
     * @var \NivelAcademico
     *
     * @ORM\ManyToOne(targetEntity="NivelAcademico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_academico", referencedColumnName="id_nivel_academico")
     * })
     */
    private $idNivelAcademico;

    /**
     * @var \OfertaAcademica
     *
     * @ORM\ManyToOne(targetEntity="OfertaAcademica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oferta_academica", referencedColumnName="id_oferta_academica")
     * })
     */
    private $idOfertaAcademica;

    public function getIdGrupo(): ?int
    {
        return $this->idGrupo;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(int $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getGrupo(): ?string
    {
        return $this->grupo;
    }

    public function setGrupo(?string $grupo): self
    {
        $this->grupo = $grupo;

        return $this;
    }

    public function getIdNivelAcademico(): ?NivelAcademico
    {
        return $this->idNivelAcademico;
    }

    public function setIdNivelAcademico(?NivelAcademico $idNivelAcademico): self
    {
        $this->idNivelAcademico = $idNivelAcademico;

        return $this;
    }

    public function getIdOfertaAcademica(): ?OfertaAcademica
    {
        return $this->idOfertaAcademica;
    }

    public function setIdOfertaAcademica(?OfertaAcademica $idOfertaAcademica): self
    {
        $this->idOfertaAcademica = $idOfertaAcademica;

        return $this;
    }

    public function selectLabel(): ?string
    {
        return $this->semestre." ".$this->grupo;
    }


}
