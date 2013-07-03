<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity,
    Application\Entity\Usuario as UsuarioEntity;

/**
 * @ORM\Table(name="usuario_acl",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="un_usuario_acl", columns={"usuario_id", "resource"})}
 * )
 * @ORM\Entity(repositoryClass="Acl\Repository\Usuario")
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $resource;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $privilege;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->updatedAt = new \DateTime();
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
