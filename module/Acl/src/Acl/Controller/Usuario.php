<?php

namespace Acl\Controller;

use CafCommon\AbstractController;

class Usuario extends AbstractController
{

    public function indexAction()
    {


        $request = $this->getRequest();

        if ($request->isPost()) {

            parse_str($request->getPost()->perms, $perms);

            $service = $this->getService();
            $service->updatePermissions(1, $perms);



        }

        $id = $this->params('id');

        $usuario = $this->getRepository('Base\Entity\Usuario')->find($id);

        $acl = $this->getEvent()->getApplication()->getConfig()['acl'];
        return array('acl' => $acl, 'usuario' => $usuario);
    }

}