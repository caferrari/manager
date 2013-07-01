<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity;

/**
 * @ORM\Table(name="pessoa",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_pessoa", columns={"cpf"})}
 * )
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="tipo_pessoa", type="string")
 * @ORM\DiscriminatorMap({
 *      "colaborador" = "Base\Entity\Pessoa",
 *      "servidor" = "Base\Entity\Servidor",
 *      "usuario" = "Base\Entity\Usuario"
 *  })
 */
class Pessoa extends AbstractEntity
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
    protected $nome;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=11)
     */
    protected $cpf;

    /**
     * @ORM\OneToOne(targetEntity="Base\Entity\Endereco")
     * @ORM\JoinColumn(name="endereco_id", referencedColumnName="id")
     */
    protected $endereco;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    protected $banco;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $agencia;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $conta;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $identidade;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $identidadeOrgao;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    protected $identidadeUF;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $telefone;


}