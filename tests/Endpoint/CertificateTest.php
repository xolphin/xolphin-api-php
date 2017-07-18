<?php namespace Tests\Endpoint;

use Tests\TestCase;

class CertificateTest extends TestCase
{
    /**
     * @description "Gett all certificates"
     */
    public function testGetAllCertificatesSuccess()
    {
        $certificates = $this->_client->certificate()->all();

        $this->assertInternalType('array',$certificates);
        if(count($certificates) > 0)
        {
            $this->assertInstanceOf('\Xolphin\Responses\Certificate', reset($certificates));
            $this->assertInstanceOf('\Xolphin\Responses\Certificate', end($certificates));
        }
    }

    /**
     * @description "Get success certificate by id"
     */
    public function testGetCertificateSuccess()
    {
        $certificate = $this->_client->certificate()->get(960000031);

        $this->assertEquals(false, $certificate->isError());
        $this->assertInstanceOf('\Xolphin\Responses\Certificate', $certificate);
        $this->assertEquals(960000031, $certificate->id);
        $this->assertEquals('test31.ssl-test.nl', $certificate->domainName);
        $this->assertEquals('Xolphin B.V.', $certificate->company);
        $this->assertInstanceOf('\DateTime', $certificate->dateExpired);
        $this->assertInstanceOf('\DateTime', $certificate->dateIssued);
    }

    /**
     * @description "Cancel the certificate"
     */
    public function testCancelSuccess()
    {
        $certificate = $this->_client->certificate()->cancel(960000031, 'Test rovoke message.');

        $this->assertEquals(false, $certificate->isError());
        $this->assertEquals('The certificate has been revoked successfully.', $certificate->getErrorMessage());
        $this->assertNull($certificate->getErrorData());
    }

}
