<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Table(name="privilege")
 * @ORM\Entity(repositoryClass="Alc\Repository\Privilege")
 * @ORM\HasLifecycleCallbacks
 */
class Privilege extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
     */
    protected $role;

    /**
     * @ORM\OneToOne(targetEntity="Acl\Entity\Resource")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id", nullable=false)
     */
    protected $resource;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

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

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function setResource(Role $resource)
    {
        $this->resource = $resource;
    }

    /** @ORM\PrePersist */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}