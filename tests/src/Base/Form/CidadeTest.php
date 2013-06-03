<?php

namespace Base\Form;

use Test\AbstractTestCase,
    Base\Form\Cidade as Form;

class CidadeTest extends AbstractTestCase
{

    /**
     * @expectedException Zend\Form\Exception\DomainException
     */
    public function testFormDeveRetornarExceptionSeEstiverVazio()
    {
        $form = new Form(array('SP' => 'SP'));

        $this->assertFalse($form->isValid());

        $form->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testFormDeveRetornarExceptionSeDadosNaoForemValidos()
    {
        $form = new Form(array('SP' => 'SP'));

        $data = array(
            'id' => 1,
            'nome' => '',
            'uf' => 'SP',
            'capital' => true
        );
        $form->setData($data);

        $this->assertFalse($form->isValid());

        $form->validate();

        $data = array(
            'id' => 1,
            'nome' => 'Campinas',
            'uf' => 'SPX',
        );
        $form->setData($data);

        $this->assertFalse($form->isValid());

        $form->validate();
    }

    public function testFormDeveValidarDados()
    {
        $form = new Form(array('SP' => 'SP'));

        $data = array(
            'id' => 1,
            'nome' => 'São Paulo',
            'uf' => 'SP',
            'capital' => true
        );

        $form->setData($data);

        $this->assertTrue($form->isValid());
    }

    public function testFormDeveSanitizarDados()
    {
        $form = new Form(array('SP' => 'SP'));

        $data = array(
            'id' => 1,
            'nome' => '   São Paulo    <table>',
            'uf' => '   SP',
            'capital' => true
        );

        $expectedAfterValidation = array(
            'id' => 1,
            'nome' => 'São Paulo',
            'uf' => 'SP',
            'capital' => true
        );

        $form->setData($data);

        $this->assertTrue($form->isValid());
        $this->assertEquals($expectedAfterValidation, $form->getData());
    }

}