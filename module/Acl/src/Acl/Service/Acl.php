<?php

namespace Acl\Service;

use CafCommon\AbstractService,
    Base\Entity\Usuario as UsuarioEntity,
    Zend\Permissions\Rbac;

class Acl extends AbstractService
{

    public function getPermissions(UsuarioEntity $usuario)
    {

        $rs = $this->em->getRepository('Acl\Entity\Usuario')->findByUsuario($usuario);

        $roles = array();
        foreach ($rs as $permission) {

            if ($permission->privilege == 'allow') {
                $roles[$permission->resource] = true;
            } else if (array_key_exists($permission->resource, $roles)) {
                unset($roles[$permission->resource]);
            }
        }

        return array_keys($roles);

    }

}