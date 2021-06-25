<?php

namespace GeoDouro\QrCodeLib;

use Exception;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\EpsWriter;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;

function getWriter(string $writerType) {
    $writerType = strtolower($writerType);
    switch($writerType) {
        case 'png':
            return new PngWriter();
        case 'eps':
            return new EpsWriter();
        case 'pdf':
            return new PdfWriter();
        case 'svg':
            return new SvgWriter();
        default:
            throw new Exception("Unsupported writer type {$writerType}");
    }
}

class QrCodeConfig {
    const DEFAULT_WRITER = 'png';
    const DEFAULT_ENCODING = 'UTF-8';
    const DEFAULT_SIZE = 300;
    const DEFAULT_MARGIN = 10;

    public $encoding;
    public $writer;
    public $size;
    public $margin;

    function __construct(
        $encoding = null,
        $writer = null,
        $size = null,
        $margin = null
    ) {
        $this->encoding = $encoding ?? self::DEFAULT_ENCODING;
        $this->writer = $writer ?? self::DEFAULT_WRITER;
        $this->size = $size ?? self::DEFAULT_SIZE;
        $this->margin = $margin ?? self::DEFAULT_MARGIN;
    }
    

    static function fromEnv() {
        $encoding = getenv('QRCODE_CONFIG_ENCODING') ? getenv('QRCODE_CONFIG_ENCODING') : QrCodeConfig::DEFAULT_ENCODING;
        $writer = getenv('QRCODE_CONFIG_WRITER') ? getenv('QRCODE_CONFIG_WRITER') : QrCodeConfig::DEFAULT_WRITER;
        $size = getenv('QRCODE_CONFIG_SIZE') ? intval(getenv('QRCODE_CONFIG_SIZE')) : QrCodeConfig::DEFAULT_SIZE;
        $margin = getenv('QRCODE_CONFIG_MARGIN') ? intval(getenv('QRCODE_CONFIG_MARGIN')) : QrCodeConfig::DEFAULT_MARGIN;
        $config = new QrCodeConfig(
            $encoding,
            $writer,
            $size,
            $margin
        );
        return $config;
    }
}

class QrCodeBuilder {

    private $config;

    function __construct(
        QrCodeConfig $config = null
    )
    {
        $this->config = $config ?? QrCodeConfig::fromEnv();
    }

    public function build(string $data): ResultInterface {
        $writer = getWriter($this->config->writer);
        $encoding = new Encoding($this->config->encoding);
        $result = Builder::create()
            ->writer($writer)
            ->writerOptions([])
            ->data($data)
            ->encoding($encoding)
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($this->config->size)
            ->margin($this->config->margin)
            ->build();
        return $result;
    }
}
?>