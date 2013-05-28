<?php

namespace Base\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result,
    Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    protected $em;
    protected $username;
    protected $password;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function setCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate()
    {
        $repository = $this->em->getRepository("Base\Entity\Usuario");

        $usuario = $repository->findOneByEmailAndSenha($this->username, $this->password);

        if ($usuario) {
            return new Result(Result::SUCCESS, $usuario);
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array('e-mail ou senha inválidos'));
        }
    }

}