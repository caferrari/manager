<?php

namespace Base\Repository;

use CafCommon\AbstractRepository;

class Cidade extends AbstractRepository
{

    public function count()
    {
        $dql = 'SELECT count(c.id) FROM Base\\Entity\\Cidade c';
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getSingleScalarResult();
    }

    public function findByUf($uf)
    {
        $dql = 'SELECT c.id, c.nome, c.uf, c.capital FROM Base\\Entity\\Cidade c WHERE c.uf = ?1 ORDER BY c.capital desc, c.nome';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $uf);

        return $query->getResult();
    }

}