<?php

namespace GeoDouro\QrCodeCli\Tests\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GeoDouro\QrCodeLib\QrCodeEncoderCustom;
use GeoDouro\QrCodeLib\QrCodeEncoderUri;

class EncodeQrCodeCommandTest extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:encode';

    protected function configure(): void
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Encode a give serialize string of data as a QRCode')
        // the full command description shown when running the command with the "--help" option
        ->setHelp('');

        $this->addOption("type", "t", null, "Type of decoder to use (custom or uri)", "custom");
        $this->addArgument("resourceName", null, "Name of the resource");
        $this->addArgument("resourceId", null, "Identifier of the resource");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $decoderType = $input->getOption("type");
        if ($decoderType !== "custom" && $decoderType != "uri") {
            throw new Exception("Invalid type {$decoderType}");
        }
        if (!$input->hasArgument("resourceName")) {
            throw new Exception("Resource name not specified");
        }
        if (!$input->hasArgument("resourceId")) {
            throw new Exception("Serialized data not specified");
        }
        $qrCodeEncoder = $decoderType === "custom"
            ? new QrCodeEncoderUri("https://test.com") // TODO: externalize
            : new QrCodeEncoderCustom();
        [$resourceName, $resourceId] = $input->getArguments();
        
        $result = $qrCodeEncoder->buildForResource($resourceName, $resourceId);

        $output->writeln($result);

        return Command::SUCCESS;
    }
}

?>