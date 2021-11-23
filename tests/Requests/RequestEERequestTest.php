<?php

declare(strict_types=1);

namespace Requests;

use Tests\TestCase;
use Xolphin\Helpers\DCVTypes;
use Xolphin\Requests\RequestEERequest;

/**
 * @covers \Xolphin\Requests\RequestEERequest
 */
class RequestEERequestTest extends TestCase
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
                    'csr' => $csr,
                    'dcvType' => DCVTypes::DNS_VALIDATION,
                    'subjectAlternativeNames' => 'xolphin.nl,xolphin.com,xolphin.net',
                    'approverFirstName' => 'John',
                    'approverLastName' => 'Doe',
                    'approverEmail' => 'johndoe@xolphin.nl',
                    'approverPhone' => '+316123456789',
                    'validate' => true
                ],
                (new RequestEERequest())
                    ->setCsr($csr)
                    ->setApproverEmail('johndoe@xolphin.nl')
                    ->setApproverFirstName('John')
                    ->setApproverLastName('Doe')
                    ->setApproverPhone('+316123456789')
                    ->setSubjectAlternativeNames([
                        'xolphin.nl',
                        'xolphin.com',
                        'xolphin.net'
                    ])
                    ->setValidate(true)
                    ->setDcvType(DCVTypes::DNS_VALIDATION)
            ],
        ];
    }

    /**
     * @dataProvider getApiRequestBodyDataProvider
     */
    public function testGetApiRequestBody(array $expectedResults, RequestEERequest $RequestEERequest): void
    {
        $actualResults = $RequestEERequest->getApiRequestBody();

        $this->assertEquals(
            $expectedResults,
            $actualResults
        );
    }
}