<?php

namespace Base\Controller;

use CafCommon\AbstractController;

class Setor extends AbstractController
{

    protected $editView = 'base/setor/novo';

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe um setor com este nome neste orgão!';
    }

    public function indexAction()
    {

        $id_orgao = $this->getRequest()->getQuery('id_orgao', null);

        $repository = $this->getRepository();

        $setores = $repository->findByOrgao($id_orgao);

        return array('setores' => $setores);

    }

}