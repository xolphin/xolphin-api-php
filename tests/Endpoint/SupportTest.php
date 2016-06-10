<?php namespace Tests\Endpoint;

use Tests\TestCase;

class SupportTest extends TestCase
{
    /**
     * @description "Get all approver emails for domain approval"
     */
    public function testApproverEmailAddressesSuccess()
    {
        $domain = 'sslcertificaten.nl';
        $approverEmails = $this->_client->support()->approverEmailAddresses($domain);

        $this->assertInternalType('array', $approverEmails);
        $this->assertCount(7, $approverEmails);
        $this->assertEquals('admin@sslcertificaten.nl', @$approverEmails[0]);
        $this->assertEquals('administrator@sslcertificaten.nl', @$approverEmails[1]);
        $this->assertEquals('hostmaster@sslcertificaten.nl', @$approverEmails[2]);
        $this->assertEquals('postmaster@sslcertificaten.nl', @$approverEmails[3]);
        $this->assertEquals('webmaster@sslcertificaten.nl', @$approverEmails[4]);
        $this->assertEquals('info@xolphin.nl', @$approverEmails[5]);
        $this->assertEquals('postmaster@xolphin.nl', @$approverEmails[6]);
    }

    /**
     * @description "Get products"
     */
    public function testGetProductsSuccess()
    {
        $products = $this->_client->support()->products();

        $this->assertInternalType('array',$products);
        if(count($products) > 0)
        {
            $this->assertInstanceOf('\Xolphin\Responses\Product', reset($products));
            $this->assertInstanceOf('\Xolphin\Responses\Product', end($products));
        }
    }

    /**
     * @description "Get product by id"
     */
    public function testGetProductSuccess()
    {
        $productId = 90;
        $product = $this->_client->support()->product($productId);

        $this->assertEquals(90, $product->id, 'Product id must be 90');
        $this->assertEquals('Comodo', $product->brand);
        $this->assertEquals('EssentialSSL', $product->name);
        $this->assertEquals('SINGLE', $product->type);
        $this->assertEquals('DV', $product->validation);
        $this->assertInternalType('array', $product->prices);
        if(count($product->prices) > 0)
        {
            $this->assertInstanceOf('\Xolphin\Responses\ProductPrice', reset($product->prices));
            $this->assertInstanceOf('\Xolphin\Responses\ProductPrice', end($product->prices));
        }
    }
}
