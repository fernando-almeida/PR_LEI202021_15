<?php

namespace GeoDouro\QrCodeCli\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GeoDouro\QrCodeLib\QrCodeEncoderCustom;
use GeoDouro\QrCodeLib\QrCodeEncoderUri;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

abstract class QrCodeCommandHelpers
{    
    static function checkTypeIsValid(string $type)
    {
        if ($type !== "json" && $type != "uri") {
            throw new Exception("Invalid type {$type}");
        }
    }
}

?>