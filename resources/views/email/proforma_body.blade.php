<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <p>Dear {{ $client_data->name }},</p>

    <p>I hope you're doing well.</p>

    <p>Please find attached the proforma invoice for the vehicle(s) discussed. This includes all relevant details such as vehicle specifications, pricing, shipping terms, and payment instructions.</p>

    <p>
        <strong>CM ID.:</strong>{{$client_data->id}}<br>
        <strong>Proforma Invoice No.:</strong> ICJ{{ \Carbon\Carbon::parse($inv->created_at)->format('Ymd') }}{{ $inv->id }}<br>
        <strong>Date:</strong> {{ \Carbon\Carbon::parse($inv->invoice_date)->format('d/m/Y') }}<br>
        <strong>Customer Name:</strong> {{ $client_data->name }}<br>
        <strong>Vehicle(s):</strong> {{ $v->manu_year }} {{-- $v->bName --}} {{ $v->fullName }} (Chassis: {{ $v->chassis_no }})<br>
        <strong>Total CNF:</strong> USD {{ number_format($inv->inv_amount, 2) }}<br>
        <strong>Destination Country: {{DB::table('countries')->where('id',$client_data->country_id)->first()->name}}</strong>
        <strong>Destination Port: {{DB::table('ports')->where('id',$client_data->port_id)->first()->name}}</strong>
    </p>

    <p>Please find the attached invoice & arrange payment as soon as possible; otherwise, iCar Japan cannot schedule shipments for your vehicles.</p>
    
    <br><br>
    <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
    <tr style="background-color: #003366; color: white; font-weight: bold;">
        <td colspan="2">PLEASE USE THE BELOW BANK DETAILS FOR YOUR PAYMENT</td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold; width: 35%;">NAME OF BANK:</td>
        <td style="color: #7b0000;">SUMITOMO MITSUI BANKING CORPORATION</td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold;">BANK ADDRESS:</td>
        <td style="color: #7b0000;">2-21, ARAMACHI, TOYAMA-SHI ,TOYAMA, JAPAN</td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold;">BRANCH NAME:</td>
        <td style="color: #7b0000;">TOYAMA BRANCH</td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold;">BENEFICIARY NAME:<br>ADDRESS:</td>
        <td style="color: #7b0000;">
            TMT CORPORATION CO.,LTD.<br>
            TOYAMA-KEN, IMIZU-SHI, NAKASHINMINATO 17-1, APA GARDEN PALACE NAKASHIN 715
        </td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold;">ACCOUNT NUMBER:</td>
        <td style="color: #7b0000;">501-1036721</td>
    </tr>
    <tr style="background-color: #c5ecff;">
        <td style="font-weight: bold;">SWIFT CODE:</td>
        <td style="color: #7b0000;">SMBCJPJT</td>
    </tr>
</table>
    <br>

    <div style="border: 1px solid red; padding: 10px; margin-top: 10px;">
        <p>
            In making your payment, please take note of the Bank Information provided in the invoice.
            The Account Number appearing here is specifically assigned for your account with iCar JAPAN, and payment received would automatically be available for your units. 
            <a href="" style="color: blue; text-decoration: underline;">
                Always mention your invoice number on the bank form when you make the TT through the bank.
            </a> 
            Please write the stock number in the description field and provide the Customer Service Department of the TT copy/copies or wire transfer copies once available.
            In addition, please instruct your bank to update the details of charges (field 71A) as <strong>OUR</strong>, as this will ensure that we will receive the full amount in the invoice.
        </p>
    </div>

    <p>We would also need the following information before we book your cars:</p>

    <p>
    <strong>Consignee Name:</strong><br>
    <strong>Consignee Address:</strong><br>
    <strong>Consignee Telephone Number:</strong><br>
    <strong>Consignee Email Address:</strong><br><br>

    <strong>Notify Party:</strong><br>
    <strong>Notify Party Address:</strong><br>
    <strong>Notify Party Telephone Number:</strong><br>
    <strong>Notify Party Email Address:</strong><br><br>

    <strong>Port Of Discharge:</strong><br>
    <strong>Final Destination to be mentioned in the Bill of Lading (If Necessary):</strong><br>
    <strong>Courier Address for the Original Documents (If Necessary):</strong>
</p>

    <p style="font-weight: bold; text-transform: uppercase; text-decoration: underline;">
    Destination port charges will be bear by the customer for all shipped units.
</p>

    <p>
    If you have any questions or require any adjustments, feel free to reach out. Once the payment is confirmed, we will proceed with the necessary arrangements.
</p>

    <p>
    Thank you for choosing <strong style="color: red;">iCar Japan</strong>.
</p>


    <p>
        Best regards,<br>
        <strong>ジャカリヤ  ホセイン</strong><br>
        Office Administrator<br>
        iCar Japan<br>
        <strong>Phone:</strong>+81-90-8099-1615<br>
        <srong>Email:</srong>info@icarjapan.com<br>
        <strong>Whatsapp:</strong>+81-90-8099-1615<br>
        <strong>Website:</strong><a href="https://icarjapan.com">www.icarjapan.com</a>
        <strong>FB:</strong><a href="https://www.facebook.com/icarjapanofficial">icarjapanofficial</a>
    </p>
</body>
</html>
