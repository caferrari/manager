<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    Crud\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="orgao")
 * @ORM\Entity(repositoryClass="Base\Repository\Orgao") @ORM\HasLifecycleCallbacks
 */
class Orgao extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Base\Entity\Endereco", inversedBy="endereco")
     */
    protected $endereco;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $telefone;

}