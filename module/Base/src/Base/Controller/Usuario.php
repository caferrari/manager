<?php

namespace Base\Controller;

use Common\AbstractController;

class Usuario extends AbstractController
{

    protected $editView = 'base/usuario/novo';

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe um usuário utilizando este email';
    }

}