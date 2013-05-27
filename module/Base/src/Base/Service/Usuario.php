<?php

namespace Base\Service;

use Common\AbstractService;

class Usuario extends AbstractService
{

    public function update(array $data)
    {

        $entity = $this->getReference($data['id']);

        if ('' === $data['senha']) {
            unset($data['senha']);
        } else {
            $entity->regenerateSalt();
        }

        $entity->setData($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}