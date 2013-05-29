<?php

namespace Base\Repository;

use Test\ModelTestCase,
    Base\Entity\Usuario as UsuarioEntity,
    Base\Service\Usuario as UsuarioService;

class UsuarioTest extends ModelTestCase
{

    public function testNaoDeveEncontrarUsuarioPorEmailQueNaoExiste()
    {

        $em = $this->getEm();

        $repository = $em->getRepository('Base\Entity\Usuario');

        $entity = $repository->findOneByEmailAndSenha('asd@asd.com.br', '12345678');

        $this->assertFalse($entity);

    }

    public function testDeveEncontrarUsuarioPorEmailQuandoASenhaEstiverCorreta()
    {

        $em = $this->getEm();

        $data = array(
            'id' => 1,
            'nome' => 'Repository test1',
            'email' => 'rt1@to.gov.br',
            'tipo' => 'a',
            'senha' => '12345678'
        );

        $service = new UsuarioService($em);
        $service->insert($data);

        $repository = $em->getRepository('Base\Entity\Usuario');

        $entity = $repository->findOneByEmailAndSenha('rt1@to.gov.br', '12345678');

        $this->assertInstanceOf('Base\Entity\Usuario', $entity);

    }

    public function testNaoDeveEncontrarUsuarioPorEmailQuandoASenhaEstiverErrada()
    {

        $em = $this->getEm();

        $data = array(
            'id' => 1,
            'nome' => 'Repository test1',
            'email' => 'rt2@to.gov.br',
            'tipo' => 'a',
            'senha' => '123456789'
        );

        $service = new UsuarioService($em);
        $service->insert($data);

        $repository = $em->getRepository('Base\Entity\Usuario');

        $entity = $repository->findOneByEmailAndSenha('rt2@to.gov.br', 'abcdefgh');

        $this->assertFalse($entity);

    }

}