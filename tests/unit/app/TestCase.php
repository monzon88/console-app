<?php
/**
 * @project   console
 * @link      https://git.setl.ru/console
 * @author    Monzon Traore <monzon@traore.ru>
 * @copyright Copyright 2017 Monzon Traore
 */

namespace monzon\cliapp\tests\unit;

use Symfony\Component\Console\Application;

/**
 * Class TestCase
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\Console\Application
     */
    protected $app;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->app = new Application();
    }
}
