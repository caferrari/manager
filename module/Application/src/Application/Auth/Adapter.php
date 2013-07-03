<?php

namespace Application\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result,
    Doctrine\ORM\EntityManager,
    Acl\Service\Acl as AclService;

class Adapter implements AdapterInterface
{

    protected $em;
    protected $acl;

    protected $username;
    protected $password;


    public function __construct(EntityManager $em, AclService $acl)
    {
        $this->em = $em;
        $this->acl = $acl;
    }

    public function setCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate()
    {
        $repository = $this->em->getRepository("Application\Entity\Usuario");

        $usuario = $repository->findOneByEmailAndSenha($this->username, $this->password);

        if ($usuario) {
            $usuario->setPermissions($this->acl->getPermissions($usuario));
            return new Result(Result::SUCCESS, $usuario);
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array('e-mail ou senha inválidos'));
        }
    }

}
