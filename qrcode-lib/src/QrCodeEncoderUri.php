<?php
namespace GeoDouro\QrCodeLib;

use Exception;

class QrCodeEncoderUri implements QrCodeEncoderInterface {
    private $baseUrl;
    private $qrCodeBuilder;

    function __construct(string $baseUrl, QrCodeBuilder $qrCodeBuilder = null)
    {
        if (!$baseUrl) {
            throw new Exception("Base URL must be specified");
        }
        // TOOD: Check is valid URL
        $this->baseUrl = $baseUrl;
        $this->qrCodeBuilder = $qrCodeBuilder ?? new QrCodeBuilder();
    }

    /**
     * @inheritDoc
     */
    function buildForResource(string $resourceName, string $resourceId): string {
        // TODO: Validate resource name
        $uri = "{$this->baseUrl}/{$resourceName}/{$resourceId}";
        $result = $this->qrCodeBuilder->build($uri);
        return $result->getString();
    }

}

?>