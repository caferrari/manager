<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class Cidade extends InputFilter
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
                            'messages' => array('isEmpty' => 'Digite um nome para a cidade')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'uf',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'messages' => array(
                                'stringLengthTooShort' => 'UF Deve ter no mínimo %min% caracteres',
                                'stringLengthTooLong' => 'UF Deve ter no máximo %max% caracteres',
                            ),
                            'min' => 2,
                            'max' => 2
                        )
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'Selecione uma UF')
                        )
                    ),
                    array(
                        'name' => 'inArray',
                        'options' => array(
                            'haystack' => array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'),
                            'messages' => array('notInArray' => 'UF não existe')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'capital',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'inArray',
                        'options' => array(
                            'haystack' => array(true, false),
                            'messages' => array('notInArray' => 'Capital deve ser verdadeiro ou falso')
                        )
                    )
                )

            )
        );

    }

}
