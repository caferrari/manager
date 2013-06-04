<?php

namespace Acl\Filter;

use Zend\InputFilter\InputFilter;

class Role extends InputFilter
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
                'name' => 'name',
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
                'name' => 'isAdmin',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'inArray',
                        'options' => array(
                            'haystack' => array(true, false),
                            'messages' => array('notInArray' => 'idAdmin deve ser verdadeiro ou falso')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'parent',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'IsInstanceOf',
                        'options' => array(
                            'className' =>  'Acl\\Entity\\Role',
                            'messages' => array('notInstanceOf' => 'O pai de uma role deve ser outra role')
                        )
                    )
                )
            )
        );

    }

}