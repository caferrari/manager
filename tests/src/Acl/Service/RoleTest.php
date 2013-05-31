<?php

namespace Acl\Service;

use Test\ModelTestCase,
    Acl\Entity\Role as RoleEntity;

class RoleTest extends ModelTestCase
{

    public function testSeInsereRole()
    {
        $em = $this->getEm();

        $service = new Role($em);
        $data = array(
            'name' => 'Visitante',
        );
        $entity = $service->insert($data);

        $this->assertInstanceOf('\Acl\Entity\Role', $entity);

        $data = array(
            'name' => 'Administrador',
            'isAdmin' => true,
            'parent' => $entity->id
        );
        $entity2 = $service->insert($data);

        $this->assertInstanceOf('\Acl\Entity\Role', $entity2);

        $data = array(
            'name' => 'Super',
            'isAdmin' => false,
            'parent' => $entity2->id
        );
        $entity3 = $service->insert($data);

        $this->assertInstanceOf('\Acl\Entity\Role', $entity3);
    }

}