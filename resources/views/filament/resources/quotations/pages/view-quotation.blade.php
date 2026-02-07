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
            font-size: 20px;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            width: 100%;
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .header table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }

        .company-section {
            width: 70%;
        }

        .logo-section {
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }

        .logo-section img {
            max-width: 120px;
            max-height: 120px;
            object-fit: contain;
            display: block;
        }

        .company-info {
            display: inline-block;
            vertical-align: top;
            text-align: left;
        }

        .company-info h1 {
            font-size: 14px;
            margin-bottom: 8px;
            margin-top: 0;
            color: #2c3e50;
        }

        .company-info p {
            font-size: 13px;
            margin-bottom: 2px;
            margin-top: 0;
            color: #555;
            line-height: 1.3;
        }

        .quotation-info {
            width: 30%;
            text-align: right;
            vertical-align: top;
        }

        .quotation-info h2 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 8px;
            margin-top: 0;
        }

        .quotation-info p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
            margin-top: 0;
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
            margin-bottom: 30px;
            width: 100%;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .details table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }

        .detail-section {
            width: 50%;
            text-align: left;
        }

        .detail-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: #7f8c8d;
            margin-bottom: 10px;
            margin-top: 0;
            font-weight: bold;
        }

        .detail-section p {
            font-size: 14px;
            margin-bottom: 8px;
            margin-top: 0;
            color: #2c3e50;
        }

        .table-section {
            margin: 30px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
            table-layout: fixed;
        }

        table thead {
            background-color: #34495e;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
            color: #2c3e50;
            text-align: center;
        }

        table td:first-child {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .total-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #333;
            margin-bottom: 20px;
        }

        .total-section table {
            width: auto;
            border-collapse: collapse;
            margin: 0;
            margin-left: auto;
            padding: 0;
        }

        .total-section table td {
            border: none;
            padding: 5px 5px;
            vertical-align: middle;
        }

        .total-row {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-row label {
            font-weight: bold;
            text-align: right;
            white-space: nowrap;
        }

        .total-row .amount {
            text-align: right;
            white-space: nowrap;
        }

        .grand-total {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .grand-total label {
            text-align: right;
            white-space: nowrap;
        }

        .grand-total .amount {
            text-align: right;
            color: #27ae60;
            white-space: nowrap;
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
            <table>
                <tr>
                    <td class="company-section">
                        <div style="display: flex;">
                            <div class="logo-section">
                                @if($company?->logo)
                                    @if(file_exists($company->logo))
                                        <img src="{{ $company->logo }}" alt="Company Logo">
                                    @else
                                        <img src="{{ asset('companies/' . $company->logo) }}" alt="Company Logo">
                                    @endif
                                @else
                                    <div style="width: 120px; height: 120px; background-color: #ecf0f1; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                        <span style="color: #95a5a6; font-size: 12px;">No Logo</span>
                                    </div>
                                @endif
                            </div>
                            <div class="company-info">
                                <h1>{{ $company?->name ?? 'Company Name' }}</h1>
                                @if($company?->address || $company?->city || $company?->state || $company?->country)
                                    <p>{{ $company->address }}@if($company?->city), {{ $company->city->name }}@endif
                                       </p>
                                @endif
 @if( $company?->state || $company?->country)
<p> @if($company?->state){{ $company->state?->name }}@endif@if($company->postalcode), {{ $company->postalcode }}@endif  </p>
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
                    </td>
                    <td class="quotation-info">
                        <h2>{{ $quotation->quotationno }}</h2>
                        <p><strong>Date:</strong> {{ $quotation->date->format('M d, Y') }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td class="detail-section">
                        <h3>Bill To</h3>
                        <p><strong>{{ $quotation->customer->company_name ?? 'N/A' }}</strong></p>
                        <p>{{ $quotation->customer->contact_person ?? 'N/A' }}</p>
                        <p>{{ $quotation->customer->phone1 ?? 'N/A' }}@if($quotation->customer->gst_number) | GSTIN: {{ $quotation->customer->gst_number }}@endif</p>
                        @php
                            $billingAddress = $quotation->customer?->addresses
                                ?->firstWhere(fn ($address) => $address->address_type === 'Billing' && $address->is_default)
                                ?? $quotation->customer?->addresses?->firstWhere('address_type', 'Billing');
                        @endphp
                        @if($billingAddress)
                            <p>{{ $billingAddress->street_address }}</p>
                            <p>
                                @if($billingAddress->city){{ $billingAddress->city }}@endif
                                @if($billingAddress->state){{ $billingAddress->city ? ', ' : '' }}{{ $billingAddress->state }}@endif
                                @if($billingAddress->pincode){{ ($billingAddress->city || $billingAddress->state) ? ' - ' : '' }}{{ $billingAddress->pincode }}@endif
                            </p>
                        @endif
                    </td>
                    <td class="detail-section">
                        <h3>Quotation Details</h3>
                        <p><strong>Quotation No:</strong> {{ $quotation->quotationno }}</p>
                        <p><strong>Date:</strong> {{ $quotation->date->format('M d, Y') }}</p>
                        <p><strong>Type:</strong> {{ $quotation->intrastate ? 'Intra State' : 'Inter State' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">S.No</th>
                        <th style="width: 35%; text-align: center;">Description</th>
                        <th style="width: 10%; text-align: center;">HSN</th>
                        <th style="width: 8%; text-align: center;">Quantity</th>
                        <th style="width: 12%; text-align: center;">Item Rate (Rs.)</th>
                        <th style="width: 12%; text-align: center;">Amount (Rs.)</th>
                        <th style="width: 7%; text-align: center;">GST %</th>
                        <th style="width: 10%; text-align: center;">GST Amount (Rs.)</th>
                        <th style="width: 12%; text-align: center;">Total (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sno = 0;
                    @endphp
                    @foreach($quotation->quotationitems as $item)

                     @php
                            $sno =  $sno  + 1;
                      @endphp       
                        <tr>
                            
                             <td style="text-align: center;">{{ $sno }}</td>
                            <td>{{ $item->item->name }} - {{ $item->item->description ?? 'N/A' }}</td>
                            <td style="text-align: center;">{{ $item->item->hsn ?? 'N/A' }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;"> {{ number_format($item->item_rate, 2) }}</td>
                            <td style="text-align: right;"> {{ number_format($item->quantity * $item->item_rate, 2) }}</td>
                            <td style="text-align: center;">{{ $item->gst->percentage ?? 0 }}%</td>
                            <td style="text-align: right;"> {{ number_format($item->item_gst, 2) }}</td>
                            <td style="text-align: right;"> {{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <table>
                <tr class="total-row">
                    <td><label>Subtotal:</label></td>
                    <td class="amount">Rs. {{ number_format($quotation->quotationitems->sum(fn($item) => $item->item_rate * $item->quantity), 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td><label>Total GST:</label></td>
                    <td class="amount">Rs. {{ number_format($quotation->quotationitems->sum('item_gst'), 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td><label>Grand Total:</label></td>
                    <td class="amount">Rs. {{ number_format($quotation->total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="details" style="margin-top: 40px; border-top: 1px solid #ddd; padding-top: 20px;">
            <table>
                <tr>
                    <td class="detail-section" style="vertical-align: top; width: 33.33%;">
                        <h3>Bank details</h3>
                        <p><strong>Account Name:</strong> {{ $company?->accountname ?? 'N/A' }}</p>
                        <p><strong>Account No:</strong> {{ $company?->accountno ?? 'N/A' }}</p>
                        <p><strong>Bank Name:</strong> {{ $company?->bankname ?? 'N/A' }}</p>
                        <p><strong>IFSC code:</strong> {{ $company?->ifsc ?? 'N/A' }}</p>
                    </td>
                    <td class="detail-section" style="vertical-align: top; width: 33.33%;">
                        <h3>Terms and conditions</h3>
                        <p style="white-space: pre-wrap;">{{ \App\Models\Setting::where('key', 'Quotation_terms_and_condiation')->value('value') ?? 'N/A' }}</p>
                    </td>
                    <td class="detail-section" style="vertical-align: top; width: 33.34%;">
                        <h3 style="text-align: right;">For {{ $company?->name ?? 'Company Name' }}</h3>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p style="text-align: right;"><strong>Authorized Signatory</strong></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
