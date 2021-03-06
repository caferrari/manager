<?php

namespace Acl\Controller;

use CafCommon\AbstractController;

class Usuario extends AbstractController
{

    public function indexAction()
    {

        $request = $this->getRequest();
        $id = $this->params('id');

        if ($request->isPost()) {

            parse_str($request->getPost()->perms, $perms);

            $service = $this->getService();
            $service->updatePermissions($id, $perms);

        }

        $usuario = $this->getRepository('Application\Entity\Usuario')->find($id);

        $acl = $this->getEvent()->getApplication()->getConfig()['acl'];
        return array('acl' => $acl, 'usuario' => $usuario);
    }

}
