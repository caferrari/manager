<?php

namespace Acl\Form;

use Common\AbstractForm;

class Role extends AbstractForm
{

    public function __construct($parents = array())
    {

        parent::__construct('role');
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
                'name' => 'name',
                'type' => 'text',
                'options' => array(
                    'label' => 'Nome'
                ),
                'attributes' => array(
                    'placeholder' => 'Nome da role'
                )
            )
        );

        $this->add(
            array(
                'name' => 'isAdmin',
                'type' => 'checkbox',
                'options' => array(
                    'label' => 'Administrador',
                    'value_options' => array(
                        'checked_value' => true,
                        'unchecked_value' => false
                    )
                )
            )
        );

        $parents = array(null => 'Nenhum') + $parents;
        $this->add(
            array(
                'name' => 'parent',
                'type' => 'select',
                'options' => array(
                    'label' => 'Pai',
                    'value_options' => $parents
                )
            )
        );

    }

    public function validate()
    {
        $originalValue = $this->get('parent')->getValue();
        $this->getInputFilter()->get('parent')->setFallbackValue($originalValue);
        parent::validate();
    }

}