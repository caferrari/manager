<?php

namespace Acl\Entity;

use Test\ModelTestCase;

class RoleTest extends ModelTestCase
{

    public function testSeCriaRole()
    {

        $role = new Role();
        $this->assertInstanceOf('Acl\Entity\Role', $role);

        $this->assertInstanceOf('\DateTime', $role->updatedAt);
        $this->assertInstanceOf('\DateTime', $role->createdAt);

    }

    public function testSeCriaRolePassandoArray()
    {

        $parent = new Role();

        $data = array(
            'name' => 'Administrador',
            'isAdmin' => true,
            'parent' => $parent
        );

        $role = new Role($data);

        $this->assertInstanceOf('Acl\Entity\Role', $role);
        $this->assertInstanceOf('Acl\Entity\Role', $role->parent);
        $this->assertInstanceOf('\DateTime', $role->updatedAt);
        $this->assertInstanceOf('\DateTime', $role->createdAt);
        $this->assertTrue($role->isAdmin);

    }

    public function testSeValidaRole()
    {

        $parent = new Role();

        $data = array(
            'name' => 'Administrador',
            'isAdmin' => true,
            'parent' => $parent
        );

        $role = new Role($data);

        $role->validate();

    }

}