<?php

namespace Base\Form;

use Crud\AbstractForm;
use Doctrine\Common\Persistence\ObjectManager;

class Cidade extends AbstractForm
{

    public function __construct(ObjectManager $objectManager = null)
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

        $this->add(
            array(
                'name' => 'uf',
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'options' => array(
                    'label' => 'UF',
                    'object_manager' => $objectManager,
                    'target_class'   => 'Base\Entity\Cidade',
                    'is_dql' => true,
                    'find_method'    => array(
                        'name'   => 'loadUF'
                    )
                )
            )
        );
    }

}