<?php

use Test\AbstractTestCase;

class ModulesTest extends AbstractTestCase
{
    public function test_se_a_classe_pdo()
    {
        $this->assertTrue(class_exists("\\PDO"));
    }
}