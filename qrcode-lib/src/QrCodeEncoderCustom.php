<?php
namespace GeoDouro\QrCodeLib;

class QrCodeEncoderCustom implements QrCodeEncoderInterface {
    
    private $qrCodeBuilder;

    function __construct(
        QrCodeBuilder $qrCodeBuilder = null
    )
    {
        $this->qrCodeBuilder = $qrCodeBuilder ?? new QrCodeBuilder();
    }
    
    function buildForResource(string $resourceName, string $resourceId): string {
        $data = [ "resourceName" => $resourceName, "resourceId" => $resourceId ];
        $serializedData = json_encode($data);
        $result = $this->qrCodeBuilder->build($serializedData);
        return $result->getString();
    }

}

?>