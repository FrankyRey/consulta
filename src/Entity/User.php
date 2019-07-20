<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \MenuRender
     *
     * @ORM\ManyToOne(targetEntity="MenuRender")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu_render", referencedColumnName="id_menu_render")
     * })
     */
    private $idMenuRender;

    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_USER");
        // your own logic
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMenuRender(): ?MenuRender
    {
        return $this->idMenuRender;
    }

    public function setIdMenuRender(?MenuRender $idMenuRender): self
    {
        $this->idMenuRender = $idMenuRender;

        return $this;
    }
}