<?php

namespace Base\Repository;

use Crud\Repository\AbstractRepository;

class Usuario extends AbstractRepository
{

    protected $listQuery = "SELECT e FROM Base\Entity\Usuario e ORDER BY e.nome";

    public function findByEmail($email)
    {
        return $this->findOneByEmail($email);
    }

    public function update(array $data)
    {

        $entity = $this->getReference($data['id']);

        if ('' === $data['senha'])
        {
            unset($data['senha']);
        } else {
            $entity->regenerateSalt();
        }

        $entity->setData($data);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

}