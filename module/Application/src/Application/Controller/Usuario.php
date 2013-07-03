<?php

namespace Application\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use CafCommon\AbstractController,
    Application\Form\Login as LoginForm;

class Usuario extends AbstractController
{

    protected $editView = 'application/usuario/novo';

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe um usuário utilizando este email';
    }

    public function configsAction()
    {

    }

    public function loginAction()
    {

        $form = new LoginForm;

        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $auth = new AuthenticationService(
                new SessionStorage('manager_' . md5(getcwd())),
                $authAdapter = $this->getService('application.authadapter')
            );

            $authAdapter->setCredentials($data['email'], $data['senha']);

            $result = $auth->authenticate();

            if ($result->isValid()) {
                return $this->redirect()->toRoute('home');
            }

            $this->error('Usuário ou senha incorretos!');

        }

        return array('form' => $form);
    }

    public function logoutAction()
    {
        $auth = new AuthenticationService(
            new SessionStorage('manager_' . md5(getcwd()))
        );

        $auth->clearIdentity();

        return $this->redirect()->toRoute('login');
    }

}
