<?php

namespace Base\Repository;

use Common\AbstractRepository;

class Usuario extends AbstractRepository
{

    protected $listQuery = 'SELECT e FROM Base\\Entity\\Usuario e ORDER BY e.nome';

    public function findByEmail($email)
    {
        return $this->findOneByEmail($email);
    }

}