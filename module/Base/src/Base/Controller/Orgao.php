<?php

namespace Base\Controller;

use CafCommon\AbstractController;

class Orgao extends AbstractController
{

    protected $editView = 'base/orgao/novo';

    protected $messages = array(
        'success' => array(
            'insert' => 'Órgão inserido com sucesso',
            'edit' => 'Órgão editado com sucesso',
            'delete' => 'Órgão excluído com sucesso'
        ),
        'error' => array(
            'insert' => 'Erro ao inserir órgão',
            'edit' => 'Erro ao editar órgão',
            'delete' => 'Erro ao excluir órgão',
            'unique' => 'Não podem haver órgãos com nome repetido'
        )
    );

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe um orgão com este nome!';
    }

    public function indexAction()
    {
        $orgaos = $this->getRepository()->findAll();
        return array('orgaos' => $orgaos);
    }

}