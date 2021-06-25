<?php

namespace GeoDouro\QrCodeLib;

require __DIR__ . "/../vendor/autoload.php";

class QrCodeDecoderCustom implements QrCodeDecoderInterface {
    public function decodeData(string $qrCodeData): QrCodeData {
        $qrCodeReader = new \Zxing\QrReader($qrCodeData, \Zxing\QrReader::SOURCE_TYPE_BLOB);
        $serializedData = $qrCodeReader->text();
        echo $serializedData;
        $deserializedData = json_decode($serializedData);
        $qrCodeData = new QrCodeData("custom", $deserializedData);
        return $qrCodeData;
    }
}
?>