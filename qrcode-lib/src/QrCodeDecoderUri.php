<?php

namespace GeoDouro\QrCodeLib;

require __DIR__ . "/../vendor/autoload.php";

class QrCodeDecoderUri implements QrCodeDecoderInterface {
    
    public function decodeData(string $encodedData): QrCodeData {
        $qrCodeReader = new \Zxing\QrReader($encodedData, \Zxing\QrReader::SOURCE_TYPE_BLOB);
        $serializedData = $qrCodeReader->text();
        $data = new QrCodeData("uri", $serializedData);
        return $data;
    }
}
?>