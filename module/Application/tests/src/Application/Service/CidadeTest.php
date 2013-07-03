<?php

namespace Application\Service;

use Test\ModelTestCase,
    Application\Entity\Cidade as CidadeEntity;

class CidadeTest extends ModelTestCase
{

    public function testSeRetornaUfsEmArray()
    {
        $em = $this->getEm();

        $service = new Cidade($em);

        $ufs = $service->getUfs();

        $this->assertEquals(27, count($ufs));
        $this->assertEquals(array_values($ufs), array_keys($ufs));

    }

}
