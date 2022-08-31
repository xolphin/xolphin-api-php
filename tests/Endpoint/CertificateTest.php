<?php

namespace Tests\Endpoint;

use DateTime;
use Tests\TestCase;
use Xolphin\Client;
use Xolphin\Exceptions\XolphinRequestException;
use Xolphin\Helpers\CertificateDownloadTypes;
use Xolphin\Responses\Certificate;

class CertificateTest extends TestCase
{
    /**
     * @description "Get all certificates"
     */
    public function testGetAllCertificatesSuccess()
    {
        $certificates = $this->_client->certificates->all();

        $this->assertIsArray($certificates);
        if (count($certificates) > 0) {
            $this->assertInstanceOf(Certificate::class, reset($certificates));
            $this->assertInstanceOf(Certificate::class, end($certificates));
        }
    }

    /**
     * @description "Get success certificate by id"
     */
    public function testGetCertificateSuccess()
    {
        $certificate = $this->_client->certificates->get(960000031);

        $this->assertEquals(false, $certificate->isError());
        $this->assertInstanceOf(Certificate::class, $certificate);
        $this->assertEquals(960000031, $certificate->id);
        $this->assertEquals('test31.ssl-test.nl', $certificate->domainName);
        $this->assertEquals('Xolphin B.V.', $certificate->company);
        $this->assertInstanceOf(DateTime::class, $certificate->dateExpired);
        $this->assertInstanceOf(DateTime::class, $certificate->dateIssued);
        $this->assertNull($certificate->dateSubscriptionExpired);
    }

    /**
     * @description "Cancel the certificate"
     */
    public function testCancelSuccess()
    {
        $certificate = $this->_client->certificates->cancel(960000031, 'Test revoke message.');

        $this->assertEquals(false, $certificate->isError());
        $this->assertEquals('The certificate has been revoked successfully.', $certificate->getMessage());
        $this->assertNull($certificate->getErrorData());
    }

    /**
     * @dataProvider certificatesDownloadSuccessDataProvider
     * @param string $format
     * @param string $startString
     * @throws XolphinRequestException
     */
    public function testCertificateDownloadSuccess(string $format, string $startString)
    {
        $cert = $this->_client->certificates->download(960000031, $format);
        $this->assertStringStartsWith($startString, $cert);
    }

    /**
     * @return array
     */
    public function certificatesDownloadSuccessDataProvider()
    {
        return [
            [CertificateDownloadTypes::CRT, '-----BEGIN CERTIFICATE-----'],
            [CertificateDownloadTypes::CSR, '-----BEGIN CERTIFICATE REQUEST-----'],
            [CertificateDownloadTypes::PKCS7, '-----BEGIN PKCS7-----'],
        ];
    }

    /**
     * @description "Test the throwing of a XolphinRequestException for NotFound"
     */
    public function testGetCertificateNotFound()
    {
        $this->expectException(XolphinRequestException::class);
        $this->expectException(XolphinRequestException::class);
        $this->expectExceptionMessage("Resource not found.");
        $this->expectExceptionCode(404);

        $this->_client->certificates->get(1);
    }

    /**
     * @description "Test the throwing of a XolphinRequestException for Unauthorized"
     */
    public function testGetAllWrongAccountCredentials()
    {
        $unauthorizedClient = new Client('someUsername', 'someWrongPassword', true);

        $this->expectException(XolphinRequestException::class);
        $this->expectExceptionMessage("Account credentials are invalid.");
        $this->expectExceptionCode(401);

        $unauthorizedClient->certificates->all();
    }
}
