<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="cidade",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_cidade_nome", columns={"nome", "uf"})},
 *      indexes={@ORM\Index(name="ind_cidade_uf", columns={"uf"})}
 * )
 * @ORM\Entity(repositoryClass="Base\Repository\Cidade") @ORM\HasLifecycleCallbacks
 */
class Cidade extends AbstractEntity
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
     * @ORM\Column(type="string", length=2)
     */
    protected $uf;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $capital;

    public function getUf()
    {
        return $this->uf;
    }

}