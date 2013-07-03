<?php

namespace Application\Repository;

use Test\ModelTestCase,
    Application\Entity\Cidade as CidadeEntity,
    Application\Service\Cidade as CidadeService;

class CidadeTest extends ModelTestCase
{

    public function testSeEncotraCidadesPorUF()
    {

        $em = $this->getEm();

        $entity = new CidadeEntity(
            array(
                'nome' => 'Palmas',
                'uf' => 'TO',
                'capital' => true
            )
        );

        $em->persist($entity);

        $entity = new CidadeEntity(
            array(
                'nome' => 'São Paulo',
                'uf' => 'SP',
                'capital' => true
            )
        );

        $em->persist($entity);

        $em->flush();

        $repository = $em->getRepository('Application\Entity\Cidade');

        $recordset = $repository->findByUf('SP');

        $this->assertTrue(is_array($recordset));
        $this->assertEquals(1, count($recordset));

        $recordset = $repository->findByUf('SP');

        $this->assertTrue(is_array($recordset));
        $this->assertEquals(1, count($recordset));
    }

    public function testSeContaAsCidadesCorretamente()
    {
        $em = $this->getEm();
        $repository = $em->getRepository('Application\Entity\Cidade');
        $this->assertEquals(2, $repository->count());
    }

}
