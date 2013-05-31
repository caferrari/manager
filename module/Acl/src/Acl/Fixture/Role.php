<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Acl\Entity\Role as RoleEntity;

class Role extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {

        $role = new RoleEntity(array('name' => 'Desativado'));
        $manager->persist($role);

        $role2 = new RoleEntity(array('name' => 'Cadastrado', 'parent' => $role));
        $manager->persist($role2);

        $role3 = new RoleEntity(array('name' => 'Administrador', 'parent' => $role2, 'isAdmin' => 1));
        $manager->persist($role3);

        $manager->flush();

    }

}