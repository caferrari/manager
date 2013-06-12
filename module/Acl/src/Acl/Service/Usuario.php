<?php

namespace Acl\Service;

use Common\AbstractService,
    Acl\Entity\Usuario as Acl,
    Base\Entity\Usuario as UsuarioEntity;

class Usuario extends AbstractService
{

    public function updatePermissions($userId, array $permissions)
    {

        $usuario = $this->getReference($userId, 'Base\Entity\Usuario');

        $q = $this->em->createQuery('DELETE FROM Acl\Entity\Usuario a WHERE a.usuario=?1');
        $q->setParameter(1, $usuario);
        $q->execute();

        foreach ($permissions as $resource => $permission) {
            $acl = new Acl(
                array(
                    'usuario' => $usuario,
                    'resource' => $resource,
                    'privilege' => $permission
                )
            );
            $this->em->persist($acl);
        }

        $this->em->flush();
    }

}