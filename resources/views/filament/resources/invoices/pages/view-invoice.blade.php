<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoiceno }}</title>
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

        .invoice-info {
            width: 30%;
            text-align: right;
            vertical-align: top;
        }

        .invoice-info h2 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 8px;
            margin-top: 0;
        }

        .invoice-info p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
            margin-top: 0;
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
        }

        table thead {
            background-color: #34495e;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
            color: #2c3e50;
            word-wrap: break-word;
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
        }

        .total-section table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .total-section table td {
            border: none;
            padding: 5px 5px;
            vertical-align: middle;
        }

        .total-row td:first-child {
            text-align: left;
            width: auto;
        }

        .total-row td:last-child {
            text-align: left;
            padding-left: 20px;
        }

        .grand-total td:first-child {
            text-align: right;
            width: auto;
        }

        .grand-total td:last-child {
            text-align: right;
            padding-left: 5px;
        }

        .total-row {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-row label {
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }

        .total-row .amount {
            text-align: left;
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
            <h1>INVOICE</h1>
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
                                <p>
                                    @if($company?->address){{ $company->address }}@endif
                                    @if($company?->city){{ $company->address ? ', ' : '' }}{{ $company->city->name }}@endif
                                    @if($company?->state){{ ($company->address || $company->city) ? ', ' : '' }}@endif
                                  
                                </p>
                                
<p>
    {{ $company->state->name }} 
  @if($company?->postalcode){{ ( $company->state ) ? ', ' : '' }}   {{ $company->postalcode }}@endif

</p>


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
                    <td class="invoice-info">
                        <h2>{{ $invoice->invoiceno }}</h2>
                        <p><strong>Date:</strong> {{ $invoice->invoicedate->format('M d, Y') }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td class="detail-section">
                        <h3>Bill To</h3>
                        <p><strong>{{ $invoice->customer->company_name ?? 'N/A' }}</strong></p>
                        <p>{{ $invoice->customer->contact_person ?? 'N/A' }}</p>
                        <p>{{ $invoice->customer->phone1 ?? 'N/A' }}</p>
                        @if($invoice->customer->email)
                            <p>{{ $invoice->customer->email }}</p>
                        @endif
                    </td>
                    <td class="detail-section">
                        <h3>Invoice Details</h3>
                        <p><strong>Invoice No:</strong> {{ $invoice->invoiceno }}</p>
                        <p><strong>Date:</strong> {{ $invoice->invoicedate->format('M d, Y') }}</p>
                        <p><strong>Type:</strong> {{ $invoice->intrastate ? 'Intra State' : 'Inter State' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">S.No</th>
                        <th style="width: 35%;">Description</th>
                        <th style="width: 10%; text-align: center;">HSN</th>
                        <th style="width: 8%; text-align: center;">Quantity</th>
                        <th style="width: 12%; text-align: center;">Item Rate (In Rs.)</th>
                        <th style="width: 12%; text-align: center;">Amount (In Rs.)</th>
                        <th style="width: 7%; text-align: center;">GST %</th>
                        <th style="width: 10%; text-align: center;">GST Amount (In Rs.)</th>
                        <th style="width: 12%; text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sno = 0;
                    @endphp
                    @foreach($invoice->items as $item)
                        @php
                            $sno = $sno + 1;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $sno }}</td>
                            <td>{{ $item->item->description ?? 'N/A' }}</td>
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
                <tr class="grand-total">
                    <td><label></label></td>
                    <td style="text-align: right;"><label>Total:</label></td>
                    <td class="amount" style="width: 15%;">Rs. {{ number_format($invoice->items->sum(fn($item) => $item->total), 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td style="width: 10%;"><label>Total (in words):</label></td>
                   
                    <td  colspan="2" style="text-align: left;">{{ numberToWords($invoice->items->sum(fn($item) => $item->total)) }}</td>
                </tr>
            </table>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center; width: 40px;">S.No</th>
                        <th rowspan="2" style="text-align: center;">HSN/SAC</th>
                        <th rowspan="2" style="text-align: right;">Taxable Value</th>
                        <th colspan="2" style="text-align: center;">CGST</th>
                        <th colspan="2" style="text-align: center;">SGST/UTGST</th>
                        <th rowspan="2" style="text-align: right;">Total Tax Amount</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Rate</th>
                        <th style="text-align: right;">Amount</th>
                        <th style="text-align: center;">Rate</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalTaxableValue = 0;
                        $totalCgstAmount = 0;
                        $totalSgstAmount = 0;
                        $totalTaxAmount = 0;
                    @endphp
                    @foreach($invoice->items as $key => $item)
                        @php
                            $sno = $key + 1;
                            $hsn = $item->item->hsn ?? 'N/A';
                            $taxableValue = $item->quantity * $item->item_rate;
                            $gstRate = $item->gst->percentage ?? 0;
                            
                            if ($invoice->intrastate) {
                                $cgstRate = $gstRate / 2;
                                $sgstRate = $gstRate / 2;
                            } else {
                                $cgstRate = $gstRate;
                                $sgstRate = 0;
                            }
                            
                            $cgstAmount = $taxableValue * ($cgstRate / 100);
                            $sgstAmount = $taxableValue * ($sgstRate / 100);
                            $totalTaxAmount = $cgstAmount + $sgstAmount;
                            
                            // Add to totals
                            $totalTaxableValue += $taxableValue;
                            $totalCgstAmount += $cgstAmount;
                            $totalSgstAmount += $sgstAmount;
                            $totalTaxAmount += $totalTaxAmount;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $sno }}</td>
                            <td style="text-align: center;">{{ $hsn }}</td>
                            <td style="text-align: right;">{{ number_format($taxableValue, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($cgstRate, 2) }}%</td>
                            <td style="text-align: right;">{{ number_format($cgstAmount, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($sgstRate, 2) }}%</td>
                            <td style="text-align: right;">{{ number_format($sgstAmount, 2) }}</td>
                            <td style="text-align: right;">{{ number_format($cgstAmount + $sgstAmount, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold; background-color: #ecf0f1;">
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;">Total</td>
                        <td style="text-align: right;">{{ number_format($totalTaxableValue, 2) }}</td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: right;">{{ number_format($totalCgstAmount, 2) }}</td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: right;">{{ number_format($totalSgstAmount, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($totalCgstAmount + $totalSgstAmount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <table>
                <tr class="total-row">
                    <td  style="width: 5%;"><label>Amount Chargeable (in words):</label></td>
                    <td style="text-align: left;">{{ numberToWords($totalCgstAmount + $totalSgstAmount) }}</td>
                </tr>
            </table>
        </div>

        <div class="details" style="margin-top: 60px;">
            <table>
                <tr>
                    <td class="detail-section" style="vertical-align: top; width: 33.33%;">
                        <h3>Bank details</h3>
                        <p><strong>Name:</strong> {{ $company?->bankname ?? 'N/A' }}</p>
                        <p><strong>Account No:</strong> {{ $company?->accountno ?? 'N/A' }}</p>
                        <p><strong>IFSC code:</strong> {{ $company?->ifsc ?? 'N/A' }}</p>
                        <p><strong>Account Holder's Name:</strong> {{ $company?->accountname ?? 'N/A' }}</p>
                    </td>
                    <td class="detail-section" style="vertical-align: top; width: 33.33%;">
                        <h3>Terms and conditions</h3>
                        <p style="white-space: pre-wrap;">{{ \App\Models\Setting::where('key', 'Invoice_terms_and_condiation')->value('value') ?? 'N/A' }}</p>
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
