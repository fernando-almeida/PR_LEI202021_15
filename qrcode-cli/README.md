# geodouro/qrcode-cli

Simple POC QRCode CLI with commands to perform encoding and decoding of URI and JSON data

## TL;DR

### Setup required package dependencies
```bash
composer install
```

### Encode/Decode URIs in QRCodes
```bash
QRCODE_BASE64=$(./bin/console encode -t uri resourceName resourceId)
./bin/console decode -t uri $QRCODE_BASE64
```

### Encode/Decode JSON data in QRCodes
```bash
QRCODE_BASE64=$(./bin/console encode -t json resourceName resourceId)
./bin/console decode -t json $QRCODE_BASE64
```
