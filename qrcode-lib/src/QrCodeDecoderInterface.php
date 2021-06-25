<?php
namespace GeoDouro\QrCodeLib;

interface QrCodeDecoderInterface {
    public function decodeData(string $encodedData): QrCodeData;
}

?>