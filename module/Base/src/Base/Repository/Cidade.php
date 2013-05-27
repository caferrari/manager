<?php

namespace Base\Repository;

use Common\AbstractRepository;

class Cidade extends AbstractRepository
{

    protected $listQuery = 'SELECT e FROM Base\\Entity\\Cidade e ORDER BY e.uf, e.nome';

    public function count()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(c.id)');
        $qb->from('Base\\Entity\\Cidade', 'c');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function loadUF()
    {
        $query = $this->getEntityManager()->createQuery('SELECT c.uf FROM Base\\Entity\\Cidade c GROUP BY c.uf ORDER BY c.uf');
        return $query->getResult();
    }

    public function findByUf($uf)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c.id, c.nome, c.uf, c.capital');
        $qb->from('Base\\Entity\\Cidade', 'c');
        $qb->where('c.uf = ?1');
        $qb->setParameter(1, $uf);
        $qb->orderBy('c.capital desc, c.nome');
        return $qb->getQuery()->getResult();
    }

}