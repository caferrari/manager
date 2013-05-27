<?php

namespace Base\Controller;

use Common\AbstractController;

class Cidade extends AbstractController
{

    protected $editView = 'base/cidade/novo';

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe uma cidade!';
    }

    public function indexAction()
    {
        $uf = $this->getRequest()->getQuery('uf', 'TO');

        $ufs = $this->getRepository()->loadUF();
        if (!$ufs) {
            $this->getService()->loadDatabase();
        }

        $cidades = $this->getRepository()->findByUf($uf);
        return array('currentUf' => $uf, 'ufs' => $ufs, 'cidades' => $cidades);
    }

}