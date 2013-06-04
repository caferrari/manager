<?php

namespace Acl\Repository;

use Common\AbstractRepository;

class Role extends AbstractRepository
{

    public function fetchParents()
    {
        $entities = $this->findAll();
        $parents = array();
        foreach ($entities as $entity) {
            $parents[$entity->id] = $entity->name;
        }
        return $parents;
    }

}