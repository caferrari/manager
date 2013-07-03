<?php

use Test\AbstractTestCase;

class ModulesTest extends AbstractTestCase
{
    public function test_se_a_classe_pdo_existe()
    {
        $this->assertTrue(class_exists("\\PDO"));
    }
}