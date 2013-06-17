<?php


namespace Base\Repository;

use CafCommon\AbstractRepository;

class Usuario extends AbstractRepository
{

    protected $listQuery = 'SELECT e FROM Base\\Entity\\Usuario e ORDER BY e.nome';

    public function findOneByEmailAndSenha($email, $senha)
    {
        $usuario = $this->findOneByEmail($email);

        if ($usuario && $usuario->verify($senha)) {
            return $usuario;
        }

        return false;
    }

}