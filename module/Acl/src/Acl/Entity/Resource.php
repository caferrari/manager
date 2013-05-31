<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Table(name="resource")
 * @ORM\Entity(repositoryClass="Alc\Repository\Resource")
 * @ORM\HasLifecycleCallbacks
 */
class Resource extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

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

    /** @ORM\PrePersist */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}