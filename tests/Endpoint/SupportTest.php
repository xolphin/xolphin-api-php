<?php namespace Tests\Endpoint;

use Tests\TestCase;
use Xolphin\Responses\Product;
use Xolphin\Responses\ProductPrice;
use Xolphin\Responses\SSLCheck;

class SupportTest extends TestCase
{
    /**
     * @description "Get all approver emails for domain approval"
     */
    public function testApproverEmailAddressesSuccess()
    {
        $domain = 'sslcertificaten.nl';
        $approverEmails = $this->_client->support->approverEmailAddresses($domain);

        $this->assertIsArray($approverEmails);
        $this->assertCount(6, $approverEmails);
        $this->assertEquals('admin@sslcertificaten.nl', @$approverEmails[0]);
        $this->assertEquals('administrator@sslcertificaten.nl', @$approverEmails[1]);
        $this->assertEquals('hostmaster@sslcertificaten.nl', @$approverEmails[2]);
        $this->assertEquals('postmaster@sslcertificaten.nl', @$approverEmails[3]);
        $this->assertEquals('webmaster@sslcertificaten.nl', @$approverEmails[4]);
        $this->assertEquals('info@xolphin.nl', @$approverEmails[5]);
    }

    /**
     * @description "Get products"
     */
    public function testGetProductsSuccess()
    {
        $products = $this->_client->support->products();

        $this->assertIsArray($products);
        if (count($products) > 0) {
            $this->assertInstanceOf(Product::class, reset($products));
            $this->assertInstanceOf(Product::class, end($products));
        }
    }

    /**
     * @description "Get product by id"
     */
    public function testGetProductSuccess()
    {
        $productId = 90;
        $product = $this->_client->support->product($productId);

        $this->assertEquals(90, $product->id, 'Product id must be 90');
        $this->assertEquals('Sectigo', $product->brand);
        $this->assertEquals('EssentialSSL', $product->name);
        $this->assertEquals('SINGLE', $product->type);
        $this->assertEquals('DV', $product->validation);
        $this->assertIsArray($product->prices);
        if (count($product->prices) > 0) {
            $this->assertInstanceOf(ProductPrice::class, reset($product->prices));
            $this->assertInstanceOf(ProductPrice::class, end($product->prices));
        }
    }

    /**
     * @description "Execute an SSLCheck for a domain"
     */
    public function testGetSSLCheck()
    {
        $domain = 'xolphin.nl';
        $sslCheckResult = $this->_client->support->sslcheck($domain);

        $this->assertInstanceOf(SSLCheck::class, $sslCheckResult);
        $this->assertIsBool($sslCheckResult->passed);
        $this->assertIsString($sslCheckResult->ifaceName);
        $this->assertIsObject($sslCheckResult->tests);
        $this->assertJson($sslCheckResult->fullJsonResult);
    }
}
