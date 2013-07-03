<?php

namespace Application\Form;

use Test\AbstractTestCase,
    Application\Form\Usuario as Form;

class UsuarioTest extends AbstractTestCase
{

    /**
     * @expectedException Zend\Form\Exception\DomainException
     */
    public function testFormDeveRetornarExceptionSeEstiverVazio()
    {
        $form = new Form;

        $this->assertFalse($form->isValid());

        $form->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testFormDeveRetornarExceptionSeDadosNaoForemValidos()
    {
        $form = new Form;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste',
            'tipo' => 'a',
            'senha' => '1234567890'
        );

        $form->setData($data);

        $this->assertFalse($form->isValid());

        $form->validate();
    }

    public function testFormDeveValidarDados()
    {
        $form = new Form;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@teste.com',
            'tipo' => 'a',
            'senha' => '1234567890'
        );

        $form->setData($data);

        $this->assertTrue($form->isValid());
    }

    public function testFormDeveSanitizarDados()
    {
        $form = new Form;

        $data = array(
            'id' => 1,
            'nome' => '   Administrador X    <table>',
            'email' => '   teste@teste.com<br />',
            'tipo' => 'a',
            'senha' => '1234567890    <span>'
        );

        $expectedAfterValidation = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@teste.com',
            'tipo' => 'a',
            'senha' => '1234567890    <span>'
        );

        $form->setData($data);

        $this->assertTrue($form->isValid());

        $this->assertEquals($expectedAfterValidation, $form->getData());
    }

}
