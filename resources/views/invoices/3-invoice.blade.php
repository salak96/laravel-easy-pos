<!-- resources/views/invoices/invoice.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family:"terminus";
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .tex-center{
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow:wrap;
        }
        th, td {
            padding-top: 2mm;
            padding-bottom:2mm;
            text-align: left;
            border-left: 0;
            border-right: 0;
        }
        
        .border-b{
            border-bottom: 1px solid #333;
        }
        .pb-1{
            padding-bottom: 1mm;
        }
        .1{
            padding-bottom: 2mm;
        }
        .pt-0{
            padding-top: 0;
        }
        .font-bold{
            font-weight: bold;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 3mm;
        }
        .invoice-header h1{
            font-size: 16px;
            margin-top: 3mm;
        }
        .invoice-header p {
            font-size: 14px;
            margin: 0;
        }
        .invoice-footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10mm;
        }
        .border-b-d{
            border-bottom: 1px dashed #999;
        }
        h2{
            padding-top:0.5mm; 
            text-align:center; 
            padding-bottom:0mm;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
        }
        .p-x-1{
            padding-left: 1mm,
            padding-right:1mm;
        }
        table th{
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <span style="margin-top: 2mm">&nbsp;&nbsp;</span>
        <h1 class="text-center" style="margin-bottom:0; font-family: 'Courier New', Courier, monospace">
            {{$site_name}}
        </h1>
        <p style="font-size: 12px;">{{$site_description}}</p>
        <h2>INVOICE</h2>
        <p>Invoice Number: #{{ str_pad($invoiceNumber, 6, '0', STR_PAD_LEFT) }}</p>
        <p>Date: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="border-b-d">Product</th>
                <th class="border-b-d tex-center">Rate</th>
                <th class="border-b-d tex-center p-x-1">QTY</th>
                <th class="border-b-d tex-center">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @foreach($items as $item)
                @php $i++; @endphp
                <tr>
                    <td  class="pb-1" style="font-size:13px" colspan="4">{{ $i.'.'.$item->product->name}}</td>
                </tr>
                <tr>
                    <td class="pt-0 border-b-d">&nbsp;&nbsp;</td>
                    <td class="tex-center pt-0 border-b-d">{{ number_format($item['price'], 2, '.', '')  }}</td>
                    <td class="tex-center pt-0 border-b-d">{{ $item['quantity'] }}</td>
                    <td class="tex-center pt-0 border-b-d">{{ number_format( ($item['price'] *  $item['quantity']), 2, '.', '')  }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="border-b-d" style="font-size:16px">
                    Total 
                </td>
                <td class="border-b-d" style="text-align: center; font-size:16px">
                    {{$currency_symbol}}{{$order->total_price}}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-footer">
        <p>Thank you for your purchase!</p>
    </div>
</body>
</html>
