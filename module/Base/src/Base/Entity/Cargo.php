<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cargo")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="tipo", type="string")
 * @ORM\DiscriminatorMap({"comissao" = "Base\Entity\CargoComissao", "efetivo" = "Base\Entity\CargoEfetivo", "simbolo" = "Base\Entity\Simbolo"})
 */
class Cargo extends AbstractEntity
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

}