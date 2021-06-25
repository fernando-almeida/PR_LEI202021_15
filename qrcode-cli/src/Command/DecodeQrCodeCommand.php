<?php

namespace GeoDouro\QrCodeCli\Command;

use Exception;
use GeoDouro\QrCodeLib\QrCodeDecoderCustom;
use GeoDouro\QrCodeLib\QrCodeDecoderUri;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DecodeQrCodeCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'decode';

    protected function configure(): void
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Decode Qt code data.')
        // the full command description shown when running the command with the "--help" option
        ->setHelp('');

        $this->addOption("type", "t", InputOption::VALUE_OPTIONAL, "Type of decoder to use (json or uri)", "json");
        $this->addArgument("encodedData", InputArgument::REQUIRED, "Base 64 QRCode encoded data");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable
        $b64EncodedQrCode = $input->getArgument('encodedData');
        $qrCode = base64_decode($b64EncodedQrCode);
        if (!$qrCode) {
            throw new Exception('Invalid QRCode');
        }

        $decoderType = $input->getOption("type");
        QrCodeCommandHelpers::checkTypeIsValid($decoderType);

        $qrCodeDecoder = $decoderType === "json"
            ? new QrCodeDecoderCustom()
            : new QrCodeDecoderUri("https://test.com"); // TODO: externalize
        
        $decodedData = $qrCodeDecoder->decodeData($qrCode);
        $outputData = is_string($decodedData->data) ? $decodedData->data : json_encode($decodedData->data);
        $output->writeln("QRCode data");
        $output->writeln($outputData);
        return Command::SUCCESS;
    }
}

?>