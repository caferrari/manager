<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity;

/**
 * @ORM\Table(name="endereco")
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cidade")
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
