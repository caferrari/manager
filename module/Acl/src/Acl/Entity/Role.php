<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Alc\Repository\Role")
 * @ORM\HasLifecycleCallbacks
 */
class Role extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true, unique=false)
     */
    protected $parent;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean", name="is_admin")
     */
    protected $isAdmin = false;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    public function setParent(Role $parent)
    {

        if ($this === $parent) {
            throw new \RuntimeException('Uma role não pode ter ela mesma como parent');
        }

        $this->parent = $parent;
    }

    /** @ORM\PrePersist */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}