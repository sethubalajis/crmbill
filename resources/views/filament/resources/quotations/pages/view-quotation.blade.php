<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation {{ $quotation->quotationno }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 36px;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            gap: 30px;
        }

        .company-section {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            flex: 1;
        }

        .logo-section {
            flex-shrink: 0;
        }

        .logo-section img {
            max-width: 120px;
            max-height: 120px;
            object-fit: contain;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-info h1 {
            font-size: 24px;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .company-info p {
            font-size: 13px;
            margin-bottom: 5px;
            color: #555;
            line-height: 1.6;
        }

        .quotation-info {
            text-align: right;
            flex-shrink: 0;
        }

        .quotation-info h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .quotation-info p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .quotation-header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .quotation-header h2 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .quotation-header p {
            font-size: 14px;
            color: #7f8c8d;
        }

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: #7f8c8d;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .detail-section p {
            font-size: 14px;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .table-section {
            margin: 30px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #34495e;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 12px;
            border: 1px solid #ddd;
            color: #2c3e50;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .total-section {
            text-align: right;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #333;
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-row label {
            font-weight: bold;
            margin-right: 20px;
            min-width: 100px;
            text-align: right;
        }

        .total-row .amount {
            min-width: 100px;
            text-align: right;
        }

        .grand-total {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .grand-total label {
            margin-right: 20px;
            min-width: 100px;
            text-align: right;
        }

        .grand-total .amount {
            min-width: 100px;
            text-align: right;
            color: #27ae60;
        }

        .print-button {
            text-align: center;
            margin-top: 30px;
        }

        .print-button button {
            padding: 10px 30px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button button:hover {
            background-color: #2980b9;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                border-radius: 0;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-title">
            <h1>QUOTATION</h1>
        </div>

        <div class="header">
            <div class="company-section">
                <div class="logo-section">
                    @if($company?->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo">
                    @else
                        <div style="width: 120px; height: 120px; background-color: #ecf0f1; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                            <span style="color: #95a5a6; font-size: 12px;">No Logo</span>
                        </div>
                    @endif
                </div>
                <div class="company-info">
                    <h1>{{ $company?->name ?? 'Company Name' }}</h1>
                    @if($company?->address)
                        <p>{{ $company->address }}</p>
                    @endif
                    @if($company?->city)
                        <p>{{ $company->city->name }}@if($company->postalcode), {{ $company->postalcode }}@endif</p>
                    @endif
                    @if($company?->state || $company?->country)
                        <p>{{ $company->state?->name }}@if($company->state && $company->country), @endif{{ $company->country?->name }}</p>
                    @endif
                    @if($company?->phone)
                        <p>Phone: {{ $company->phone }}@if($company->phone2), {{ $company->phone2 }}@endif</p>
                    @endif
                    @if($company?->email)
                        <p>Email: {{ $company->email }}</p>
                    @endif
                    @if($company?->gstinno)
                        <p>GSTIN: {{ $company->gstinno }}</p>
                    @endif
                </div>
            </div>
            <div class="quotation-info">
                <h2>{{ $quotation->quotationno }}</h2>
                <p><strong>Date:</strong> {{ $quotation->date->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="details">
            <div class="detail-section">
                <h3>Bill To</h3>
                <p><strong>{{ $quotation->customer->company_name ?? 'N/A' }}</strong></p>
                <p>{{ $quotation->customer->contact_person ?? 'N/A' }}</p>
                <p>{{ $quotation->customer->phone1 ?? 'N/A' }}</p>
                @if($quotation->customer->email)
                    <p>{{ $quotation->customer->email }}</p>
                @endif
            </div>

            <div class="detail-section">
                <h3>Quotation Details</h3>
                <p><strong>Quotation No:</strong> {{ $quotation->quotationno }}</p>
                <p><strong>Date:</strong> {{ $quotation->date->format('M d, Y') }}</p>
                <p><strong>Type:</strong> {{ $quotation->intrastate ? 'Intra State' : 'Inter State' }}</p>
            </div>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: right;">Rate</th>
                        <th style="text-align: center;">GST %</th>
                        <th style="text-align: right;">GST Amount</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotation->quotationitems as $item)
                        <tr>
                            <td>{{ $item->item->name ?? 'N/A' }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹ {{ number_format($item->item_rate, 2) }}</td>
                            <td style="text-align: center;">{{ $item->gst->percentage ?? 0 }}%</td>
                            <td style="text-align: right;">₹ {{ number_format($item->item_gst, 2) }}</td>
                            <td style="text-align: right;">₹ {{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-row">
                <label>Subtotal:</label>
                <div class="amount">₹ {{ number_format($quotation->quotationitems->sum(fn($item) => $item->item_rate * $item->quantity), 2) }}</div>
            </div>
            <div class="total-row">
                <label>Total GST:</label>
                <div class="amount">₹ {{ number_format($quotation->quotationitems->sum('item_gst'), 2) }}</div>
            </div>
            <div class="grand-total">
                <label>Grand Total:</label>
                <div class="amount">₹ {{ number_format($quotation->total, 2) }}</div>
            </div>
        </div>

        <div class="print-button">
            <button onclick="window.print()">Print Quotation</button>
        </div>
    </div>
</body>
</html>
