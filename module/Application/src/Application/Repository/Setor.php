<?php

namespace Application\Repository;

use CafCommon\AbstractRepository;

class Setor extends AbstractRepository
{


    public function findByOrgao($orgao_id)
    {
        $orgao = $this->getEntityManager()->getReference('Application\Entity\Orgao', $orgao_id);
        // return $this->findBy(array('orgao' => $orgao, 'parent' => null), array('nome' => 'ASC'));

        $dql = 'SELECT s, p FROM Application\\Entity\\Setor s LEFT JOIN s.parent p WHERE s.orgao=?1 ORDER BY s.nome, p.nome';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $orgao);

        return $query->getResult();
    }


}
