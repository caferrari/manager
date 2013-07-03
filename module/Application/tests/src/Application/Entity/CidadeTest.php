<?php

namespace Application\Entity;

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
                    'capital' => true
                ),
                'Digite um nome para a cidade; UF Deve ter no mínimo 2 caracteres'
            ),

            array(
                array(
                    'nome' => 'Bla',
                    'uf' => '',
                    'capital' => true
                ),
                'UF Deve ter no mínimo 2 caracteres'
            ),
            array(
                array(
                    'nome' => '',
                    'uf' => 'SP',
                    'capital' => false
                ),
                'Digite um nome para a cidade'
            ),
            array(
                array(
                    'nome' => 'Campinas',
                    'uf' => 'SPX',
                    'capital' => true
                ),
                'UF Deve ter no máximo 2 caracteres'
            ),
            array(
                array(
                    'nome' => 'BlaBla',
                    'uf' => 'XX',
                    'capital' => false
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
                    'uf' => 'SP',
                    'capital' => true
                )
            ),
            array(
                array(
                    'nome' => 'Araguacema',
                    'uf' => 'TO',
                    'capital' => true
                )
            )
        );

    }

}
