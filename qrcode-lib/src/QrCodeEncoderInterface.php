<?php
namespace GeoDouro\QrCodeLib;

interface QrCodeEncoderInterface {
    /**
     * Build QRCode for a given resource
     *
     * @param string $resourceName
     * @param string $resourceId
     * @return void
     */
    public function buildForResource(string $resourceName, string $resourceId);

    // TODO: Add domain specific methods to abstract the generation of QRCode for each use case
}

?>