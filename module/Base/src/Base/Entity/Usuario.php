<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="usuario",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_usuario_email", columns={"email"})}
 * )
 * @ORM\Entity(repositoryClass="Base\Repository\Usuario") @ORM\HasLifecycleCallbacks
 */
class Usuario extends AbstractEntity
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
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $senha;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $tipo;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $salt;

    /** @ORM\PreFlush */
    public function validate($event)
    {
        if (!$this->isValid()) {
            throw new \RunTimeException('Dados inválidos');
        }
    }

    public function __set($var, $value)
    {
        if ($var == 'senha') {
            $this->setSenha($value);
            return $value;
        }
        parent::__set($var, $value);
    }

    public function setSenha($senha)
    {
        $bcrypt = new Bcrypt();
        $this->senha = $bcrypt->create($this->generatePassword($senha));
    }

    public function verify($senha)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->verify($this->generatePassword($senha), $this->senha);
    }

    public function generatePassword($password)
    {
        return $password . sha1($password . $this->getSalt());
    }

    public function getSalt()
    {
        if (null == $this->salt) {
            $this->regenerateSalt();
        }
        return $this->salt;
    }

    public function regenerateSalt()
    {
        $this->salt = sha1(uniqid(mt_rand(), true));
    }
}