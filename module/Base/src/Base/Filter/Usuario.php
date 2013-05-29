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
                            'messages' => array('isEmpty' => 'Nome não deve estar em branco')
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
                            'messages' => array('isEmpty' => 'e-mail é obrigatório!')
                        )
                    ),
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'messages' => array('emailAddressInvalidFormat' => 'e-mail inválido')
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array('stringLengthTooLong' => 'E-mail deve ter no máximo %max% caracteres'),
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

                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array('stringLengthTooShort' => 'Senha deve ter no mínimo %min% caracteres'),
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
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'Tipo não deve estar em branco')
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array(
                                'stringLengthTooShort' => 'Tipo deve ter no mínimo %min% caractere',
                                'stringLengthTooLong' => 'Tipo deve ter no máximo %max% caractere',

                            ),
                            'min' => 1,
                            'max' => 1
                        )
                    )
                )
            )
        );

    }

}