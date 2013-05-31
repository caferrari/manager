<?php

namespace Acl\Service;

use Common\AbstractService;

class Role extends AbstractService
{

    public function insert(array $data)
    {

        if (isset($data['parent']) && $data['parent']) {
            $data['parent'] = $this->em->getReference($this->getEntityName(), $data['parent']);
        }

        $entity = $this->createEntity($data);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}