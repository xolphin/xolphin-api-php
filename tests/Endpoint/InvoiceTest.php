<?php namespace Tests\Endpoint;

use Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * @description "Get all invoices"
     */
    public function testGetAllCInvoicesSuccess()
    {
        $invoices = $this->_client->invoice()->all();
        $this->assertInternalType('array', $invoices);

        if(count($invoices) > 0)
        {
            $this->assertInstanceOf('\Xolphin\Responses\Invoice', reset($invoices));
            $this->assertInstanceOf('\Xolphin\Responses\Invoice', end($invoices));
        }
    }

    /**
     * @description "Get success invoice by id"
     */
    public function testGetInvoiceSuccess()
    {
        $invoice = $this->_client->invoice()->get(224075);

        $this->assertEquals(false, $invoice->isError());
        $this->assertInstanceOf('\Xolphin\Responses\Invoice', $invoice);
        $this->assertEquals(224075, $invoice->id);
    }
}