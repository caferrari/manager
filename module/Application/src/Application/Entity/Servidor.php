<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="servidor",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_servidor_matricula", columns={"matricula"})}
 * )
 * @ORM\Entity
 */
class Servidor extends Pessoa
{

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $matricula;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Setor")
     * @ORM\JoinColumn(name="lotacao_id", referencedColumnName="id")
     */
    protected $lotacao;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\CargoEfetivo")
     * @ORM\JoinColumn(name="cargo_efetivo_id", referencedColumnName="id")
     */
    protected $cargoEfetivo;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\CargoComissao")
     * @ORM\JoinColumn(name="cargo_comissao_id", referencedColumnName="id")
     */
    protected $cargoComissao;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Simbolo")
     * @ORM\JoinColumn(name="simbolo_id", referencedColumnName="id")
     */
    protected $simbolo;

}
