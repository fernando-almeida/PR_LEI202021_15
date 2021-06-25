<?php

namespace GeoDouro\QrCodeCli\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DecodeQrCodeCommandTest extends KernelTestCase
{
    // the name of the command (the part after "bin/console")
    public function testExecute() {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            // pass arguments to the helper
            'username' => 'Wouter',

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Username: Wouter', $output);
    }
    
}

?>