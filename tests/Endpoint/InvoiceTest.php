<?php

namespace Tests\Endpoint;

use Tests\TestCase;
use Xolphin\Helpers\InvoiceDownloadTypes;
use Xolphin\Responses\Invoice;

class InvoiceTest extends TestCase
{
    /**
     * @description "Get all invoices"
     */
    public function testGetAllInvoicesSuccess()
    {
        $invoices = $this->_client->invoices->all();
        $this->assertIsArray($invoices);

        if (count($invoices) > 0) {
            $this->assertInstanceOf(Invoice::class, reset($invoices));
            $this->assertInstanceOf(Invoice::class, end($invoices));
        }
    }

    /**
     * @description "Get success invoice by id"
     */
    public function testGetInvoiceSuccess()
    {
        $invoice = $this->_client->invoices->get(224075);

        $this->assertEquals(false, $invoice->isError());
        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertEquals(224075, $invoice->id);
    }

    /**
     * @description "Get PDF success invoice by id"
     */
    public function testDownloadInvoicePdfSuccess()
    {
        $pdf = $this->_client->invoices->download(224075, InvoiceDownloadTypes::PDF);

        $this->assertNotNull($pdf);

        $pdfHex = bin2hex($pdf);
        $this->assertStringStartsWith('255044462d', $pdfHex);
    }

    /**
     * @description "Get UBL success invoice by id"
     */
    public function testDownloadInvoiceUblSuccess()
    {
        $ubl = $this->_client->invoices->download(224075, InvoiceDownloadTypes::UBL);

        $this->assertNotNull($ubl);
        $this->assertStringStartsWith('<UBLDocument>', $ubl);
    }
}
