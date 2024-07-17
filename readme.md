# Xolphin API wrapper for PHP

xolphin-php-api is a library which allows quick integration of the [Xolphin REST API](https://api.xolphin.com) in PHP to
automated ordering, issuance and installation of SSL Certificates.

## About Xolphin

[Xolphin](https://www.xolphin.nl/) is the largest supplier of [SSL Certificates](https://www.sslcertificaten.nl)
and [Digital Signatures](https://www.digitalehandtekeningen.nl) in the Netherlands. Xolphin has a professional team
providing reliable support and rapid issuance of SSL Certificates at an affordable price from industry leading brands
such as Sectigo, GeoTrust, GlobalSign, Thawte and Symantec.

## Library installation

Library can be installed via [Composer](https://getcomposer.org/)

```
composer require xolphin/xolphin-api-php
```

And updated via

```
composer update xolphin/xolphin-api-php
```

### Upgrade guide: from v2.x to v3.x
- Access pagination attributes from `$response->getPagination()->{{method}};`
- Remove all EE (EncryptionEverywhere) blocks from your code, it has finally been removed.
- Make sure you enforce the right types since we enforce strict-typing now.

### Upgrade guide from v1.8.3 to v2.x

Update your `xolphin/xolphin-api-php` dependency to `^2.0` in your `composer.json` file.

#### Renamed classes

All endpoint classes have been renamed to a more generic name `<resource>Endpoint`. You should update your usages.

#### Calling Endpoint classes

All endpoint classes are started during startup They can be called using `$client->certificates->all()` instead
of `$client->certificate()->all()`.

#### Using Helpers instead of strings

In version 2.0.0 we introduced Helper classes. These classes contain constants of all static string variables (enums).
Use these constants instead of a string, because we will alter these constants whenever we change the corresponding
value in the API.

For instance, when creating a DCV for a domain:

```php
$dcvDomain = new Xolphin\Requests\DCVDomain('someDomain', Xolphin\Helpers\DCVTypes::EMAIL_VALIDATION, 'someemail@address.com');
```

#### Certificate download() method returns string

The method `download()` on the class `CertificatesEndpoint` now returns the certificate string instead of
the `GuzzlestreamInterface`.

## Usage

### Client initialization

```php
<?php

require 'vendor/autoload.php';

$client = new Xolphin\Client('<username>', '<password>');
```

### Rate Limiting

#### Current limit

```php
$limit = $client->getLimit();
echo $limit . PHP_EOL;
```

#### Requests remaining for limit

```php
$requestsRemaining = $client->getRequestsRemaining();
echo $requestsRemaining . PHP_EOL;
```

### Requests

#### Get list of requests

```php
$requests = $client->requests->all();
foreach($requests as $request) {
    echo $request->id . PHP_EOL;
}
```

#### Get request by ID

```php
$request = $client->requests->get(1234);
echo $request->id;
```

#### Request certificate

```php
$products = $client->support->products();

// request Sectigo EssentialSSL certificate for 1 year
$request = $client->requests->create($products[1]->id, 1, '<csr_string>', DCVTypes::EMAIL_VALIDATION)
    ->setAddress("Address")
    ->setApproverFirstName("FirstName")
    ->setApproverLastName("LastName")
    ->setApproverPhone("+12345678901")
    ->setZipcode("123456")
    ->setCity("City")
    ->setCompany("Company")
    ->setApproverEmail('email@domain.com')
    //currently available languages defined in RequestLanguages
    ->setLanguage(RequestLanguage::ENGLISH)
    ->addSubjectAlternativeNames('test1.domain.com')
    ->addSubjectAlternativeNames('test2.domain.com')
    ->addSubjectAlternativeNames('test3.domain.com')
    ->addDcv(new \Xolphin\Requests\DCVDomain('test1.domain.com', DCVTypes::EMAIL_VALIDATION, 'email1@domain.com'))
    ->addDcv(new \Xolphin\Requests\DCVDomain('test2.domain.com', DCVTypes::EMAIL_VALIDATION, 'email2@domain.com'));

$client->requests->send($request);
```

#### Reissue certificate

```php
// Reissue a current certificate
$reissue = new \Xolphin\Requests\ReissueRequest('<csr_string>', DCVTypes::EMAIL_VALIDATION);
$reissue->setApproverEmail('email@domain.com');

$client->certificates->reissue(<certificate_id>, $reissue);
```

#### Renew certificate

```php
// Renew a current certificate
$currentCertificate = $client->certificates->get(<certificate_id>);

$renew = new \Xolphin\Requests\RenewRequest($currentCertificate->product->id, <years>, '<csr_string>', DCVTypes::FILE_VALIDATION);
$renew->setApproverRepresentativeEmail('email@domain.com');

$client->certificates->renew(<certificate_id>, $renew);
```

#### Create a note

```php
$result = $client->requests->sendNote(1234, 'My message');
```

#### Get list of notes

```php
$notes =  $client->requests->getNotes(1234);
foreach($notes as $note){
    echo $note->messageBody . PHP_EOL;
}
```

#### Send a "Sectigo Subscriber Agreement" email

```php
//currently available languages defined in RequestLanguages
$client->requests->sendSectigoSAEmail(1234, 'mail@example.com', RequestLanguage::ENGLISH);
```

### Certificate

#### Certificates list and expirations

```php
$certificates = $client->certificates->all();
foreach($certificates as $certificate) {
    echo $certificate->id . ' - ' . $certificate->isExpired() . "\n";
}
```

#### Download certificate

```php
$certificates = $client->certificates->all();
$cert = $client->certificates->download($certificates[0]->id, CertificateDownloadTypes::CRT);
file_put_contents('cert.crt', $cert);
```

### Support

#### List of products

```php
$products = $client->support->products();
foreach($products as $product) {
    echo $product->id . PHP_EOL;
}
```

#### Decode CSR

```php
$csr = $client->support->decodeCSR('<your csr string>');
echo $csr->type;
```

### Invoices

#### List of invoices

```php
$invoices = $client->invoices->all();
foreach($invoices as $invoice) {
    echo $invoice->id . ' ' . $invoice->invoiceNr . ' ' . $invoice->amount . PHP_EOL;
}
```

#### Download Invoice in PDF format

```php
$invoices = $client->invoices->all();
$invoicePdf = $client->invoices->download($invoices[0]->id, InvoiceDownloadTypes::PDF);
file_put_contents('invoice.pdf' , $invoicePdf);
```
