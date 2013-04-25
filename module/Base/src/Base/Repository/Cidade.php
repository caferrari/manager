<?php

namespace Base\Repository;

use Crud\AbstractRepository;

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

    private function loadDatabase()
    {

        if ($this->count()) {
            return;
        }

        set_time_limit(0);
        $files = glob(getcwd() . '/data/assets/cidades/*.json');
        $em = $this->getEntityManager();

        $em->getConnection()->beginTransaction();
        foreach ($files as $file) {
            $dados = json_decode(file_get_contents($file));
            foreach ($dados->cidades as $cidade) {
                $data = array(
                    'nome' => $cidade->nome,
                    'uf' => $dados->sigla,
                    'capital' => $cidade->nome == $dados->capital
                );
                $entity = $this->createEntity($data);
                $em = $this->getEntityManager();
                $em->persist($entity);
            }
            $em->flush();
        }
        $em->getConnection()->commit();
    }

    public function loadUF()
    {
        $this->loadDatabase();
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