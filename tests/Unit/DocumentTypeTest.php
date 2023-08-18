<?php
use Tests\TestCase;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Invoice;

class DocumentTypeTest extends TestCase
{
    public function testCreateDocumentTypeContract()
    {
        $controller = new DocumentController();

        $request = new Request([
            'contract_number' => 888,
            'issue_date' => '2023-08-01',
            'total_amount' => 888.00,
            'contract_field' => 'Field 88888',
            'description' => 'Description of contract',
            'client_name' => 'Rebeca Costa 888',
            'service_description' => 'Software Development',
            'total_value' => 888.00,
        ]);

        $response = $controller->createDocumentType($request, 'contract');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('contract', [
            'contract_number' => 888,
            'issue_date' => '2023-08-01',
            'total_amount' => 888.00,
            'contract_field' => 'Field 88888',
            'description' => 'Description of contract',
            'client_name' => 'Rebeca Costa 888',
            'service_description' => 'Software Development',
            'total_value' => 888.00,
        ]);
    }


    public function testUpdateDocumentTypeContract()
    {
        $contract = Contract::find(1);

        $controller = new DocumentController();

        $request = new Request([
            'contract_number' => 456,
            'total_amount' => 2000,
            'contract_field' => 'Updated field value',
            'client_name' => 'Updated Client',
            'service_description' => 'Updated Service Description',
            'total_value' => 2000.00,
        ]);

        $response = $controller->updateDocumentType($request, 'contract', $contract->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('contract', [
            'contract_number' => 456,
            'total_amount' => 2000,
            'contract_field' => 'Updated field value',
            'client_name' => 'Updated Client',
            'service_description' => 'Updated Service Description',
            'total_value' => 2000.00,
        ]);
    }

    public function testCreateDocumentTypeInvoice()
    {
        $controller = new DocumentController();

        $request = new Request([
            'invoice_number' => 33,
            'invoice_field' => 'Field value',
            'issue_date' => '2023-08-01',
            'total_amount' => 33.00,
            'total_value' => 33.00,
            'description' => 'Description of invoice',
            'client_name' => 'CARLA LAMARA',
            'service_description' => 'Este é um exemplo de descricao para INVOICE'
        ]);

        $response = $controller->createDocumentType($request, 'invoice');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('invoice', [
            'invoice_number' => 33,
            'invoice_field' => 'Field value',
            'issue_date' => '2023-08-01',
            'total_amount' => 33.00,
            'total_value' => 33.00,
            'description' => 'Description of invoice',
            'client_name' => 'CARLA LAMARA',
            'service_description' => 'Este é um exemplo de descricao para INVOICE'
        ]);
    }


    public function testUpdateDocumentTypeInvoice()
    {
        $invoice = Invoice::find(1);

        $controller = new DocumentController();

        $request = new Request([
            'invoice_number' => 987,
            'total_amount' => 1200,
            'invoice_field' => 'Updated invoice field value',
            'description' => 'Updated description of invoice',
            'client_name' => 'Updated Client Name',
            'service_description' => 'Updated Service Description'
        ]);

        $response = $controller->updateDocumentType($request, 'invoice', $invoice->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('invoice', [
            'id' => $invoice->id,
            'invoice_number' => 987,
            'total_amount' => 1200,
            'invoice_field' => 'Updated invoice field value',
            'description' => 'Updated description of invoice',
            'client_name' => 'Updated Client Name',
            'service_description' => 'Updated Service Description'
        ]);
    }

}
