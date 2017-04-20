<?php
/**
 * @project   console
 * @link      https://git.setl.ru/console
 * @author    Monzon Traore <monzon@traore.ru>
 * @copyright Copyright 2017 Monzon Traore
 */

namespace tests\unit\Commands;

use Symfony\Component\Console\Tester\CommandTester;
use monzon\cliapp\tests\unit\TestCase;
use monzon\cliapp\Commands\DummyCommand;

/**
 * Class DummyCommandTest
 */
class DummyCommandTest extends TestCase
{
    /**
     * Test if command returns expected string
     *
     * @test
     */
    public function testExecute() {

        $this->app->add(new DummyCommand());
        $command = $this->app->find('dummy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['command' => $command->getName()]);
        $this->assertRegExp('/Hello World!/', $commandTester->getDisplay());
    }
}
