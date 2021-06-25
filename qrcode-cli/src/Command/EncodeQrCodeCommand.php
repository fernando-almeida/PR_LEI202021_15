<?php

namespace GeoDouro\QrCodeCli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GeoDouro\QrCodeLib\QrCodeEncoderCustom;
use GeoDouro\QrCodeLib\QrCodeEncoderUri;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EncodeQrCodeCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'encode';

    protected function configure(): void
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Encode a give serialize string of data as a QRCode')
        // the full command description shown when running the command with the "--help" option
        ->setHelp('');

        $this->addOption("type", "t", InputOption::VALUE_OPTIONAL, "Type of decoder to use (json or uri)", "json");
        $this->addArgument("resourceName", InputArgument::REQUIRED, "Name of the resource");
        $this->addArgument("resourceId", InputArgument::REQUIRED, "Identifier of the resource");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $encoderType = $input->getOption("type");
        QrCodeCommandHelpers::checkTypeIsValid($encoderType);
        $qrCodeEncoder = $encoderType === "json"
            ? new QrCodeEncoderCustom()
            : new QrCodeEncoderUri("https://test.com"); // TODO: externalize
        ['resourceName' => $resourceName, 'resourceId' => $resourceId] = $input->getArguments();
        $result = $qrCodeEncoder->buildForResource($resourceName, $resourceId);

        $encodedResult = base64_encode($result);
        $output->writeln($encodedResult);

        return Command::SUCCESS;
    }
}

?>