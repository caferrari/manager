<?php

namespace Base\Form;

use Crud\AbstractForm;

class Usuario extends AbstractForm
{

    public function __construct()
    {

        parent::__construct('usuario');
        $this->setInputFilter($this->getInputFilter());
        $this->setAttribute('method', 'post');

        $this->add(
            array(
                'name' => 'id',
                'type' => 'hidden'
            )
        );

        $this->add(
            array(
                'name' => 'nome',
                'type' => 'text',
                'options' => array(
                    'label' => 'Nome'
                ),
                'attributes' => array(
                    'placeholder' => 'Nome do Usuário'
                )
            )
        );

        $this->add(
            array(
                'name' => 'email',
                'type' => 'email',
                'options' => array(
                    'label' => 'E-mail'
                ),
                'attributes' => array(
                    'placeholder' => 'seuemail@dominio.com'
                )
            )
        );


        $this->add(
            array(
                'name' => 'senha',
                'type' => 'password',
                'options' => array(
                    'label' => 'Senha'
                )
            )
        );

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'security'
            )
        );

        $this->add(
            array(
                'name' => 'tipo',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'Tipo',
                    'value_options' => array(
                        'a' => 'Administrador',
                        'b' => 'Administrador de Órgão',
                        'c' => 'Operador'
                    )
                )
            )
        );
    }
}