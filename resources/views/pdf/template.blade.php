<!DOCTYPE html>
<html>
<head>
    <title>{{ $document->title }}</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .contract-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
        .contract-heading {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .contract-section {
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            margin-bottom: 15px;
        }
        .label {
        font-weight: bold;
        color: #555;
        }
        .value {
            margin-left: 10px;
            font-weight: normal;
            color: #333;
        }
        .description {
            margin-top: 10px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="logo">
        <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Logo" class="logo">
    </div>
    <div class="header">
        <div class="contract-section">
            <span class="label">Document Type:</span>
            <span class="value">{{ $document->contract_field ? 'CONTRACT' : 'INVOICE' }}</span>
        </div>
    </div>
    <div class="contract-section">
        <span class="label">{{ $document->contract_field ? 'Contract' : 'Invoice' }} Number:</span>
        <span class="value">{{ $document->contract_field ? $document->contract_number : $document->invoice_number }}</span>
    </div>
    <div class="contract-section">
        <span class="label">Issue Date:</span>
        <span class="value">{{ $document->issue_date }}</span>
    </div>
    <div class="contract-section">
        <span class="label">Total Amount:</span>
        <span class="value">${{ number_format($document->total_amount, 2) }}</span>
    </div>
    <div class="contract-section">
        <span class="label">Client Name:</span>
        <span class="value">{{ $document->client_name }}</span>
    </div>
    <div class="contract-section">
        <span class="label">Service Description:</span>
        <span class="value">{{ $document->service_description }}</span>
    </div>
    <div class="contract-section">
        <span class="label">Total Value:</span>
        <span class="value">${{ number_format($document->total_value, 2) }}</span>
    </div>
    @if ($document->contract_field)
        <div class="contract-section">
            <span class="label">Additional Contract Field:</span>
            <span class="value">{{ $document->contract_field }}</span>
        </div>
    @endif
    @if ($document->description)
        <div class="contract-section description">
            <span class="label">Description:</span>
            <p>{{ $document->description }}</p>
        </div>
    @endif

    <div class="footer">
        <img src="data:image/png;base64,{{ $footerBase64 }}" alt="Rodapé" class="footer-logo">
        <br>
        © {{ date('Y') }} Your company. All rights reserved
    </div>

</body>
</html>
