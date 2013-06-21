<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM,
    CafCommon\AbstractEntity,
    Zend\Crypt\Password\Bcrypt,
    Zend\Permissions\Acl\Acl;

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

    protected $permissions;
    protected $acl;

    /** @ORM\PreUpdate
     *  @ORM\PrePersist
     */
    public function validate()
    {
        parent::validate();
        if (($this->senha && strlen($this->senha) < 60)) {
            $this->senha = $this->getBcrypt()->create($this->generatePassword($this->senha));
        }

        if ('' == $this->senha) {
            $if = $this->getInputFilter();
            $if->get('senha')->setAllowEmpty(false);
            $if->get('senha')->setRequired(true);

            parent::validate();
        }

        return true;
    }

    public function verify($senha)
    {
        return $this->getBcrypt()->verify($this->generatePassword($senha), $this->senha);
    }

    public function getBcrypt()
    {
        return new Bcrypt(
            array(
                'salt' => $this->getSalt(),
                'cost' => 13
            )
        );
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

    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function regenerateSalt()
    {
        $this->salt = sha1(uniqid(mt_rand(), true));
    }

    public function setAcl(Acl $acl)
    {
        $this->acl = $acl;
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function isAdmin()
    {
        return $this->isMasterAdmin() || 'b' == $this->tipo;
    }

    public function isMasterAdmin()
    {
        return 'a' == $this->tipo;
    }
}