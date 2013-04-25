<?php

namespace Base\Form;

use Crud\AbstractForm;

class Cidade extends AbstractForm
{

    public function __construct(array $ufs)
    {

        parent::__construct('cidade');
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
                    'placeholder' => 'Nome da cidade'
                )
            )
        );

        $this->add(array(
                'name' => 'uf',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'UF',
                    'value_options' => $ufs
                )
            )
        );

    }

}