<?php

declare(strict_types=1);

namespace Requests;

use Tests\TestCase;
use Xolphin\Helpers\DCVTypes;
use Xolphin\Helpers\RequestLanguage;
use Xolphin\Requests\CertificateRequest;
use Xolphin\Requests\DCVDomain;

/**
 * @covers \Xolphin\Requests\CertificateRequest
 */
class CertificateRequestTest extends TestCase
{
    public function getApiRequestBodyDataProvider(): array
    {
        $csr = '-----BEGIN CERTIFICATE REQUEST-----
MIICvjCCAaYCAQAweTELMAkGA1UEBhMCTkwxEzARBgNVBAMMCnhvbHBoaW4ubmwx
EDAOBgNVBAcMB0Fsa21hYXIxFTATBgNVBAoMDFhvbHBoaW4gQi5WLjEWMBQGA1UE
CAwNTm9vcmQtSG9sbGFuZDEUMBIGA1UECwwLRGV2ZWxvcG1lbnQwggEiMA0GCSqG
SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDCvP5LZYWrhuSiwC47VmEFAWeTt1yDx6bv
wq7bjQ6B+6ZYWIvQku/X6nXSWaVUCR0FgwOBf15txtG9HAOITC+5E73yyPbqLbIz
fKC0omyGvPmKWbtVUH7PXYHVJgMJRg23NcpuqGEk+No7z+TbSVTj4bICF7IeLAlc
ox/u9Qbf9WSgB8IQ25cOV8Qb3eZJMGnWO4x7idcufLponx9WSg5+tBBb9V7nNVjr
SsMPgfb0q0eKBcervW2r7QdHCmY9XTh1OTpsRO9SHp5dJ4DJRZqMPRge6uZiRWyM
43T4bPGokhweJuV+utP/AUgTRzPH9mufdl9Cl/jxRUD+tWW2ZQUbAgMBAAGgADAN
BgkqhkiG9w0BAQsFAAOCAQEAiUkleqhn/3htgW/QGVLKgwiWBi5TwXYfe4bL+SRf
AZl65+Ehj01APYjX+uWQTKxLCVW9U8eblMjdYkW/HMtzXXencvwNvZmD9EpYF5dG
xpvcon85enPajM8GKexM+x+EUqo5zO5VBJe/G3mcGr0HuxdXY/QUAsFpAQYl7vnK
IOBgQBDLvCRzay3qaEJJeRTwN4B8XiAL/24YVfvJYB/Gi0KmqCQinuUIrd9tX2YR
wEzpgvmRNRGmJbEwI38+4SuMK8DFvhITeWWQXhCsfTVyW9S8kDQnSt/tACxg7jIN
8B+gLyeWR6G3Rrgsp2hDF4QYLJtF2ozS5fWEanrN05uDlA==
-----END CERTIFICATE REQUEST-----';

        return [
            'Includes all filled fields' => [
                [
                    'product' => 1,
                    'years' => 1,
                    'csr' => $csr,
                    'dcvType' => DCVTypes::DNS_VALIDATION,
                    'language' => RequestLanguage::DUTCH,
                    'subjectAlternativeNames' => 'xolphin.nl,xolphin.com,xolphin.net',
                    'dcv' => json_encode([
                        new DCVDomain(
                            'xolphin.nl',
                            DCVTypes::DNS_VALIDATION,
                        ),
                        new DCVDomain(
                            'xolphin.com',
                            DCVTypes::EMAIL_VALIDATION,
                        ),
                        new DCVDomain(
                            'xolphin.net',
                            DCVTypes::FILE_VALIDATION,
                        ),
                    ]),
                    'company' => 'Xolphin B.V.',
                    'department' => 'Development',
                    'address' => 'Main Street 1',
                    'zipcode' => '1234 AB',
                    'city' => 'Alkmaar',
                    'approverFirstName' => 'John',
                    'approverLastName' => 'Doe',
                    'approverEmail' => 'johndoe@xolphin.nl',
                    'approverPhone' => '+316123456789',
                    'kvk' => '1234567890',
                    'reference' => 'foobar',
                    'referenceOrderNr' => 'foobar',
                    'sa_email' => 'foobar',
                    'uniqueValueDcv' => 'foobar',
                    'disableFreeSan' => true,
                ],
                (new CertificateRequest(1, 1, $csr, DCVTypes::DNS_VALIDATION))
                    ->addDcv(
                        new DCVDomain(
                            'xolphin.nl',
                            DCVTypes::DNS_VALIDATION,
                        ),
                    )
                    ->addDcv(
                        new DCVDomain(
                            'xolphin.com',
                            DCVTypes::EMAIL_VALIDATION,
                        ),
                    )
                    ->addDcv(
                        new DCVDomain(
                            'xolphin.net',
                            DCVTypes::FILE_VALIDATION,
                        ),
                    )
                    ->addSubjectAlternativeNames('xolphin.nl')
                    ->addSubjectAlternativeNames('xolphin.com')
                    ->addSubjectAlternativeNames('xolphin.net')
                    ->setLanguage(RequestLanguage::DUTCH)
                    ->setCompany('Xolphin B.V.')
                    ->setDepartment('Development')
                    ->setAddress('Main Street 1')
                    ->setZipcode('1234 AB')
                    ->setCity('Alkmaar')
                    ->setApproverFirstName('John')
                    ->setApproverLastName('Doe')
                    ->setApproverEmail('johndoe@xolphin.nl')
                    ->setApproverPhone('+316123456789')
                    ->setKvk('1234567890')
                    ->setReference('foobar')
                    ->setReferenceOrderNr('foobar')
                    ->setSaEmail('foobar')
                    ->setUniqueValueDcv('foobar')
                    ->setDisableFreeSan(true),
            ],
            'Only has base fields' => [
                [
                    'product' => 1,
                    'years' => 1,
                    'csr' => $csr,
                    'dcvType' => DCVTypes::DNS_VALIDATION,
                ],
                new CertificateRequest(1, 1, $csr, DCVTypes::DNS_VALIDATION)
            ],
        ];
    }

    /**
     * @dataProvider getApiRequestBodyDataProvider
     */
    public function testGetApiRequestBody(array $expectedResults, CertificateRequest $certificateRequest): void
    {
        $actualResults = $certificateRequest->getApiRequestBody();

        $this->assertEquals(
            $expectedResults,
            $actualResults
        );
    }
}