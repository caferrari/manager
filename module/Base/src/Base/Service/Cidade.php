<?php

namespace Base\Service;

use Common\AbstractService;

class Cidade extends AbstractService
{

    public function loadDatabase()
    {

        set_time_limit(0);
        $files = glob(getcwd() . '/data/assets/cidades/*.json');

        $this->em->getConnection()->beginTransaction();
        foreach ($files as $file) {
            $dados = json_decode(file_get_contents($file));
            foreach ($dados->cidades as $cidade) {
                $data = array(
                    'nome' => $cidade->nome,
                    'uf' => $dados->sigla,
                    'capital' => $cidade->nome == $dados->capital
                );
                $entity = $this->createEntity($data);
                $this->em->persist($entity);
            }
            $this->em->flush();
        }
        $this->em->getConnection()->commit();
    }

}