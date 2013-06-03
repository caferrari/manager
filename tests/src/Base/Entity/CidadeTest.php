<?php

namespace Base\Entity;

use Test\ModelTestCase;

class CidadeTest extends ModelTestCase
{

    /**
     * @dataProvider providerForValidCidades
     */
    public function testSeValidaCidade($data)
    {
        $cidade = new Cidade($data);
        $this->assertTrue($cidade->isValid());
    }

    /**
     * @dataProvider providerForInvalidCidades
     */
    public function testSeDaExecptionAoInserirCidadeInvalida($data, $message)
    {
        try {
            $cidade = new Cidade($data);
            $cidade->validate();
            $this->fail('Cidade foi inserida mesmo inválida, deveria dar exception: ' . $message);
        } catch (\Exception $e) {
            $this->assertEquals($message, $e->getMessage());
            $this->assertInstanceOf('RuntimeException', $e);
        }
    }

    public function providerForInvalidCidades()
    {
        return array(
            array(
                array(
                    'nome' => '',
                    'uf' => '',
                ),
                'Digite um nome para a cidade; UF Deve ter no mínimo 2 caracteres'
            ),

            array(
                array(
                    'nome' => 'Bla',
                    'uf' => '',
                ),
                'UF Deve ter no mínimo 2 caracteres'
            ),
            array(
                array(
                    'nome' => '',
                    'uf' => 'SP',
                ),
                'Digite um nome para a cidade'
            ),
            array(
                array(
                    'nome' => 'Campinas',
                    'uf' => 'SPX',
                ),
                'UF Deve ter no máximo 2 caracteres'
            ),
            array(
                array(
                    'nome' => 'BlaBla',
                    'uf' => 'XX',
                ),
                'UF não existe'
            )
        );

    }

    public function providerForValidCidades()
    {
        return array(
            array(
                array(
                    'nome' => 'São Paulo',
                    'uf' => 'SP'
                )
            ),
            array(
                array(
                    'nome' => 'Araguacema',
                    'uf' => 'TO'
                )
            )
        );

    }

}