<?php

namespace Base\Filter;

use Zend\InputFilter\InputFilter;

class Usuario extends InputFilter
{

    public function __construct()
    {

        $this->add(
            array(
                'name' => 'id',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Digits',
                        'options' => array(
                            'messages' => array('notDigits' => 'ID inválido')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'Digite um nome!')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'e-Mail é obrigatório!')
                        )
                    ),
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'messages' => array('emailAddressInvalidFormat' => 'Digite um email válido!')
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array('stringLengthTooLong' => 'Deve ter no maximo %max% caracteres'),
                            'max' => 100
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'senha',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array('stringLengthTooShort' => 'Deve ter no mínimo %min% caracteres'),
                            'min' => 8
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'tipo',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array('stringLengthTooShort' => 'Deve ter no mínimo %min% caracteres', 'stringLengthTooLong' => 'Deve ter no maximo %max% caracteres'),
                            'min' => 1,
                            'max' => 8
                        )
                    )
                )
            )
        );

    }

}