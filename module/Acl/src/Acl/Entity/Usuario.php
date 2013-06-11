<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity,
    Base\Entity\Usuario as UsuarioEntity;

/**
 * @ORM\Table(name="privilege")
 * @ORM\Entity(repositoryClass="Alc\Repository\Privilege")
 * @ORM\HasLifecycleCallbacks
 */
class Usuario extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $resource;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $privilege;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    public function setUsuario(UsuarioEntity $usuario)
    {
        $this->usuario = $usuario;
    }

    /** @ORM\PrePersist */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}