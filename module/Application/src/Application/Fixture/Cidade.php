<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Application\Entity\Cidade as CidadeEntity;

class Cidade extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {

        set_time_limit(0);
        $files = glob(getcwd() . '/data/assets/cidades/*.json');

        $manager->getConnection()->beginTransaction();
        foreach ($files as $file) {
            $dados = json_decode(file_get_contents($file));
            foreach ($dados->cidades as $cidade) {
                $data = array(
                    'nome' => $cidade->nome,
                    'uf' => $dados->sigla,
                    'capital' => $cidade->nome == $dados->capital
                );
                $entity = new CidadeEntity($data);
                $manager->persist($entity);
            }
            $manager->flush();
        }
        $manager->getConnection()->commit();

    }

}
