<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="endereco")
 * @ORM\Entity(repositoryClass="Base\Repository\Endereco") @ORM\HasLifecycleCallbacks
 */
class Endereco extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base\Entity\Cidade")
     */
    protected $cidade;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $logradouro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $complemento;

    /**
     * @ORM\Column(type="string", length=9)
     */
    protected $cep;

}