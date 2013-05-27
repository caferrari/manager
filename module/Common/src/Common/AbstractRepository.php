<?php

namespace Common;

use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository
{

    protected $pairColumn = 'nome';

    public function findAll()
    {
        $query = $this->getEntityManager()->createQuery($this->listQuery);
        return $query->getResult();
    }

    public function fetchPairs()
    {
        $entities = $this->findAll();
        $list = array();
        foreach ($entities as $item) {
            $list[$item->id] = $item->{$this->pairColumn};
        }
        return $list;
    }

}