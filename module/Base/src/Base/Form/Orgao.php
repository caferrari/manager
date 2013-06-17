<?php

namespace Base\Form;

use CafCommon\AbstractForm;

class Orgao extends AbstractForm
{

    public function __construct()
    {

        parent::__construct('orgao');
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
                    'placeholder' => 'Nome do órgão'
                )
            )
        );

    }

}