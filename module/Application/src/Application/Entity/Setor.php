<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="setor", uniqueConstraints={@ORM\UniqueConstraint(name="un_setor_orgao_nome", columns={"orgao_id", "nome"})})
 * @ORM\Entity(repositoryClass="Application\Repository\Setor")
 */
class Setor extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Orgao")
     * @ORM\JoinColumn(name="orgao_id", referencedColumnName="id")
     */
    protected $orgao;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Setor", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Setor", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $lotacao;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $telefone;

}
