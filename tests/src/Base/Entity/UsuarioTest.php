<?php

namespace Base\Entity;

use Test\ModelTestCase;

class UsuarioTest extends ModelTestCase
{

    public function testSeClasseUsuarioExiste()
    {
        $this->assertTrue(class_exists('Base\Entity\Usuario'));
        $this->assertInstanceOf('Base\Entity\Usuario', new Usuario);
    }

}