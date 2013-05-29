<?php

namespace Base\Entity;

use Test\ModelTestCase;

class UsuarioTest extends ModelTestCase
{

    public function testSeClasseUsuarioExiste()
    {
        $this->assertTrue(class_exists('Base\Entity\Usuario'));
        $this->assertInstanceOf('Base\Entity\Usuario', new Usuario);
    }

    /**
     * @dataProvider providerForValidUsuarios
     */
    public function testSeValidaUsuario($data)
    {
        $usuario = new Usuario($data);
        $this->assertTrue($usuario->isValid());
    }

    /**
     * @dataProvider providerForValidUsuarios
     */
    public function testSeEncriptaSenhaCorretamente($data)
    {

        $usuario = new Usuario($data);
        $usuario->validate();

        $this->assertStringStartsWith('$2y$', $usuario->senha);
        $this->assertTrue($usuario->verify($data['senha']));

    }

    /**
     * @dataProvider providerForInvalidUsuarios
     */
    public function testSeDaExecptionAoInserirUsuarioInvalido($data, $message) {
        $em = $this->getEm();

        try {
            $usuario = new Usuario($data);
            $usuario->validate();
        } catch (\Exception $e) {
            $this->assertInstanceOf('RuntimeException', $e);
            $this->assertEquals($message, $e->getMessage());
            return;
        }

        $this->fail('Usuário foi inserido mesmo inválido, deveria dar exception: ' . $message);

    }

    public function providerForInvalidUsuarios()
    {
        return array(
            array(
                array(
                    'nome' => '',
                    'email' => 'asdasdasd@to.gov.br',
                    'senha' => '12345678',
                    'tipo' => 'a'
                ),
                'Nome não deve estar em branco'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'email' => 'sasdasdasd',
                    'senha' => 'asdfghjk',
                    'tipo' => 'a'
                ),
                'e-mail inválido'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'email' => '',
                    'senha' => 'asdfghjk',
                    'tipo' => 'a'
                ),
                'e-mail é obrigatório!'
            ),
            array(
                array(
                    'nome' => 'Ble bleble',
                    'email' => 'adminasd@to.gov.br',
                    'senha' => 'asdfghjk',
                    'tipo' => ''
                ),
                'Tipo não deve estar em branco'
            ),
            array(
                array(
                    'nome' => 'Ble bleble',
                    'email' => 'adminasdf@to.gov.br',
                    'senha' => 'asdfghjk',
                    'tipo' => 'ab'
                ),
                'Tipo deve ter no máximo 1 caractere'
            ),
            array(
                array(
                    'nome' => 'Bli bli',
                    'email' => 'adminasdasd@to.gov.br',
                    'senha' => '123',
                    'tipo' => 'b'
                ),
                'Senha deve ter no mínimo 8 caracteres'
            )

        );

    }

    public function providerForValidUsuarios()
    {
        return array(
            array(
                array(
                    'nome' => 'Administrador',
                    'email' => 'teste@to.gov.br',
                    'senha' => '12345678',
                    'tipo' => 'a'
                )
            ),
            array(
                array(
                    'nome' => 'Outro Usuário',
                    'email' => 'teste2@to.gov.br',
                    'senha' => 'asdfghjk',
                    'tipo' => 'a'
                )
            )
        );

    }

}