<?php


namespace Base\Service;

use Test\ModelTestCase,
    Base\Entity\Usuario as UsuarioEntity;

class UsuarioTest extends ModelTestCase
{


    public function testSeInsereUsuario()
    {

        $em = $this->getEm();

        $service = new Usuario($em);
        $data = array(
            'nome' => 'Administrador',
            'email' => 'teste@to.gov.br',
            'senha' => '12345678',
            'tipo' => 'a'
        );
        $entity = $service->insert($data);

        $this->assertInstanceOf('\Base\Entity\Usuario', $entity);
    }

    public function testSeAtualizaDadosDoUsuarioSemAlterarSenha()
    {

        $em = $this->getEm();

        $service = new Usuario($em);

        $senhaAntiga = $em->getRepository('Base\Entity\Usuario')->findOneById(1)->senha;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@to.gov.br',
            'tipo' => 'a',
            'senha' => ''
        );

        $entity = $service->update($data);

        $this->assertInstanceOf('\Base\Entity\Usuario', $entity);
        $this->assertEquals($senhaAntiga, $entity->senha);

    }

    public function testSeAtualizaDadosDoUsuarioAlterandoASenha()
    {

        $em = $this->getEm();

        $service = new Usuario($em);

        $senhaAntiga = $em->getRepository('Base\Entity\Usuario')->findOneById(1)->senha;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@to.gov.br',
            'tipo' => 'a',
            'senha' => '1234567890'
        );

        $entity = $service->update($data);

        $this->assertInstanceOf('\Base\Entity\Usuario', $entity);
        $this->assertNotEquals($senhaAntiga, $entity->senha);

    }

    public function testSeDeletaUsuario()
    {

        $em = $this->getEm();

        $service = new Usuario($em);

        $entity = $service->delete(1);

        $this->assertInstanceOf('\Base\Entity\Usuario', $entity);

        $entity = $em->getRepository('Base\Entity\Usuario')->findOneById(1);

        $this->assertNull($entity);

    }

    /**
     * @expectedException RuntimeException
     */
    public function testSeInsereUsuarioInvalido()
    {
        $em = $this->getEm();

        $service = new Usuario($em);
        $data = array(
            'nome' => 'Administrador',
            'email' => 'bla',
            'senha' => '12345678',
            'tipo' => 'a'
        );
        $entity = $service->insert($data);

        $this->assertInstanceOf('\Base\Entity\Usuario', $entity);
    }

}