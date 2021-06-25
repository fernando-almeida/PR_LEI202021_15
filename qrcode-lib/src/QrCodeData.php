<?php
namespace GeoDouro\QrCodeLib;

class QrCodeData {

    public $type;
    public $data;

    
    function __construct(string $type, $data) {
        $this->type = $type;
        $this->data = $data;
    }
}

?>