<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Invoice;
use Dompdf\Dompdf;


class DocumentController extends Controller
{

    public function downloadPdf($type, $id)
    {
        try {
            $document = null;
            $fileName = '';

            if ($type === 'invoice') {
                $document = Invoice::findOrFail($id);
                $fileName = 'invoice_' . $id . '.pdf';
            } elseif ($type === 'contract') {
                $document = Contract::findOrFail($id);
                $fileName = 'contract_' . $id . '.pdf';
            } else {
                return response()->json(['error' => 'Invalid document type'], 400);
            }

            $logoPath = storage_path('app/public/logos/logo_contract.png');
            $logoBase64 = base64_encode(file_get_contents($logoPath));

            $footerPath = storage_path('app/public/logos/rodape.png');
            $footerBase64 = base64_encode(file_get_contents($footerPath));

            $html = view('pdf.template', compact('document', 'logoBase64', 'footerBase64'))->render();

            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);

            // Renderize o PDF
            $dompdf->render();

            // Faça o download do PDF gerado
            return $dompdf->stream($fileName);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    public function createDocumentType(Request $request, $type)
    {
        $validationRules = [];
        $document = null;

        if ($type === 'contract') {
            $validationRules = [
                'contract_number' => 'required|integer',
                'issue_date' => 'required|date',
                'total_amount' => 'required|numeric',
                'contract_field' => 'nullable|string|max:191',
                'description' => 'nullable|string',
                'client_name' => 'required|string|max:255',
                'service_description' => 'required|string',
                'total_value' => 'required|numeric',
            ];
            $document = new Contract();
        } elseif ($type === 'invoice') {
            $validationRules = [
                'invoice_number' => 'required|integer',
                'issue_date' => 'required|date',
                'total_amount' => 'required|numeric',
                'invoice_field' => 'nullable|string|max:191',
                'description' => 'nullable|string',
                'client_name' => 'required|string|max:255',
                'service_description' => 'required|string',
                'total_value' => 'required|numeric',
            ];
            $document = new Invoice();
        } else {
            return response()->json(['error' => 'Invalid document type'], 400);
        }

        $data = $request->all();

        $missingFields = [];
        foreach ($validationRules as $field => $rule) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            return response()->json(['error' => 'Missing fields: ' . implode(', ', $missingFields)], 400);
        }

        $data['type'] = $type;

        try {
            $document->fill($data);
            $document->save();
            return response()->json([
                'Message' => 'Document created successfully',
                'Document type' => $type,
                'Document id' => $document->id,
                'Client name' => $data['client_name'],
                'Service description' => $data['service_description'],
                'Total value' => $data['total_value']
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the document. Please try again later.'], 500);
        }
    }

    public function updateDocumentType(Request $request, $type, $id)
    {
        $validationRules = [];
        $document = null;

        if ($type === 'contract') {
            $validationRules = [
                'contract_number' => 'integer',
                'issue_date' => 'date',
                'total_amount' => 'numeric',
                'contract_field' => 'nullable|string|max:191',
                'description' => 'nullable|string',
                'client_name' => 'nullable|string|max:255',
                'service_description' => 'nullable|string',
                'total_value' => 'numeric',
            ];
            $document = Contract::find($id);
        } elseif ($type === 'invoice') {
            $validationRules = [
                'invoice_number' => 'integer',
                'issue_date' => 'date',
                'total_amount' => 'numeric',
                'invoice_field' => 'nullable|string|max:191',
                'description' => 'nullable|string',
                'client_name' => 'nullable|string|max:255',
                'service_description' => 'nullable|string',
                'total_value' => 'numeric',
            ];
            $document = Invoice::find($id);
        } else {
            return response()->json(['error' => 'Invalid document type'], 400);
        }

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $data = $request->validate($validationRules);

        try {
            $document->fill($data);
            $document->save();

            // Formatando created_at e updated_at
            $formattedCreatedAt = $document->created_at->format('Y-m-d H:i:s');
            $formattedUpdatedAt = $document->updated_at->format('Y-m-d H:i:s');

            // Retornar todos os valores do documento atualizado
            $documentData = [
                'Id' => $document->id,
                'Issue Date' => $document->issue_date,
                'Total Amount' => $document->total_amount,
                'Client Name' => $document->client_name,
                'Service Description' => $document->service_description,
                'Description' => $document->description,
                'Created' => $formattedCreatedAt,
                'Updated' => $formattedUpdatedAt
            ];

            if ($document instanceof Invoice) {
                $documentData['Invoice Number'] = $document->invoice_number;
                $documentData['Invoice Field'] = $document->invoice_field;
            } elseif ($document instanceof Contract) {
                $documentData['Contract Number'] = $document->contract_number;
                $documentData['Contract Field'] = $document->contract_field;
                $documentData['Total Value'] = $document->total_value;
            }

            return response()->json([
                'message' => 'Document updated successfully',
                'document' => $documentData
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the document'], 500);
        }

    }

}
