# Xolphin API wrapper for PHP
xolphin-php-api is a library which allows quick integration of the [Xolphin REST API](https://api.xolphin.com) in PHP to automated ordering, issuance and installation of SSL Certificates.

## About Xolphin
[Xolphin](https://www.xolphin.nl/) is the largest supplier of [SSL Certificates](https://www.sslcertificaten.nl) and [Digital Signatures](https://www.digitalehandtekeningen.nl) in the Netherlands. Xolphin has a professional team providing reliable support and rapid issuance of SSL Certificates at an affordable price from industry leading brands such as Comodo, GeoTrust, GlobalSign, Thawte and Symantec.

## Library installation

Library can be installed via [Composer](https://getcomposer.org/)

```
composer require xolphin/xolphin-api-php
```

And updated via

```
composer update xolphin/xolphin-api-php
```

## Usage

### Client initialization

```php
<?php

require 'vendor/autoload.php';

$client = new Xolphin\Client('<username>', '<password>');
```

### Requests

#### Get list of requests

```php
$requests = $client->request()->all();
foreach($requests as $request) {
    echo $request->id . "\n";
}
```

#### Get request by ID

```php
$request = $client->request()->get(1234);
echo $request->id;
```

#### Request certificate

```php
$products = $client->support()->products();

// request Comodo EssentialSSL certificate for 1 year
$request = $client->request()->create($products[1]->id, 1, '<csr_string>', 'EMAIL')
    ->setAddress("Address")
    ->setApproverFirstName("FirstName")
    ->setApproverLastName("LastName")
    ->setApproverPhone("+12345678901")
    ->setZipcode("123456")
    ->setCity("City")
    ->setCompany("Company")
    ->setApproverEmail('email@domain.com')
    //currently available languages: en, de, fr, nl
    ->setLanguage('en')
    ->addSubjectAlternativeNames('test1.domain.com')
    ->addSubjectAlternativeNames('test2.domain.com')
    ->addSubjectAlternativeNames('test3.domain.com')
    ->addDcv(new \Xolphin\Requests\RequestDCV('test1.domain.com', 'EMAIL', 'email1@domain.com'))
    ->addDcv(new \Xolphin\Requests\RequestDCV('test2.domain.com', 'EMAIL', 'email2@domain.com'));

$client->request()->send($request);
```

#### Reissue certificate

```php
// Reissue a current certificate
$reissue = new \Xolphin\Requests\Reissue('<csr_string>', 'EMAIL');
$reissue->setApproverEmail('email@domain.com');

$client->certificate()->reissue(<certificate_id>, $reissue);
```

#### Renew certificate

```php
// Renew a current certificate
$currentCertificate = $client->certificate()->get(<certificate_id>);

$renew = new \Xolphin\Requests\Renew($currentCertificate->product, <years>, '<csr_string>', 'FILE');
$renew->setApproverEmail('email@domain.com');

$client->certificate()->renew(<certificate_id>, $renew)
```

#### Create a note

```php
$result = $client->request()->sendNote(1234,'My message');
```

#### Get list of notes

```php
$notes =  $client->request()->getNotes(1234);
foreach($notes as $note){
    echo $note->messageBody . "\n";
}
```

#### Send a "Comodo Subscriber Agreement" email

```php
//currently available languages: en, de, fr, nl
$client->request()->sendComodoSAEmail(1234, 'mail@example.com', 'en');
```

#### Request an "Encryption Everywhere" certificate
```php
$request = $this->_client->request()->createEE();
$request->setCsr(<csr_string>);
$request->setApproverEmail('email@example.com');
$request->setApproverFirstName('FirstName');
$request->setApproverLastName('SecondName');
$request->setApproverPhone(+12345678901);
$request->setDcvType('FILE');
// if you just want to validate
$request->setValidate(true);

$response = $this->_client->request()->sendEE($request);
```

### Certificate

#### Certificates list and expirations

```php
$certificates = $client->certificate()->all();
foreach($certificates as $certificate) {
    echo $certificate->id . ' - ' . $certificate->isExpired() . "\n";
}
```

#### Download certificate

```php
$certificates = $client->certificate()->all();
$cert = $client->certificate()->download($certificates[0]->id);
file_put_contents('cert.crt', $cert);
```

### Support

#### List of products

```php
$products = $client->support()->products();
foreach($products as $product) {
    echo $product->id . "\n";
}
```

#### Decode CSR

```php
$csr = $client->support()->decodeCSR('<your csr string>');
echo $csr->type;
```

### Use last response
You can find `X-RateLimit-Remaining` and `X-RateLimit-Limit` values in last response headers.

```php
if(isset($client->last_response)){
	var_dump($client->last_response->getHeaders());
}
```
