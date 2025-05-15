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

    <p>I trust this message finds you well.</p>

    <p>
        We would like to respectfully remind you that 
        <strong>Invoice No.:</strong> ICJ{{ \Carbon\Carbon::parse($inv->created_at)->format('Ymd') }}{{ $inv->id }} 
        issued on {{ \Carbon\Carbon::parse($inv->created_at)->format('F j, Y') }}, 
        is approaching its due date of {{ \Carbon\Carbon::parse($inv->created_at)->addDays(7)->format('F j, Y') }} (7 days Timeline). 
        This invoice pertains to the export of vehicles arranged as per our agreement.
    </p>

    <p>Kindly find the invoice details below for your reference:</p>

    <p><strong>Invoice Summary:</strong></p>
    <p>
        <strong>CUSTOMER NAME:</strong> {{ $client_data->name }}<br>
        <strong>Vehicle(s) Stock ID:</strong> {{ $v->stock_id }}<br>
        <strong>Total CNF:</strong> USD {{ number_format($inv->inv_amount, 2) }}<br>
        <strong>Deposited Amount:</strong> USD {{ number_format($payment->sum('amount'), 2) }}<br>
        <strong>Total Due Amount:</strong> USD {{ number_format($inv->inv_amount - $payment->sum('amount'), 2) }}<br>
        <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($inv->created_at)->addDays(7)->format('F j, Y') }}<br>
        <strong>Payment Terms:</strong> Net 7 Days<br>
        <strong>Destination Country:</strong> {{ DB::table('countries')->where('id', $client_data->country_id)->first()->name }}<br>
        <strong>Destination Port:</strong> {{ DB::table('ports')->where('id', $client_data->port_id)->first()->name }}
    </p>

    <p style="text-decoration: underline;"><strong style="color:red;">Please find the attached invoice & arrange payment as soon as possible to avoid late fees. </strong></p>
    
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
            Please write the stock number in the description field and provide the Customer Service Department with the TT copy/copies or wire transfer copies once available.
            In addition, please instruct your bank to update the details of charges (field 71A) as <strong>OUR</strong>, as this will ensure that we will receive the full amount in the invoice.
        </p>
    </div>

    <p>A copy of the invoice is attached to this email. We kindly request that the payment be settled on or before the due date. Bank details and remittance instructions are provided within the invoice.</p>

    <p style="text-decoration:underline"><strong>If payment has already been processed, please disregard this notice. If you require any clarification or additional documentation, please do not hesitate to contact us.</strong></p>

    <p>We sincerely appreciate your continued partnership and prompt attention to this matter.</p>
    <p>
        Thank you for choosing <strong style="color: red;">iCar Japan</strong>.
    </p>

    <p>
        Best regards,<br>
        <strong>ジャカリヤ ホセイン</strong><br>
        Office Administrator<br>
        iCar Japan<br>
        <strong>Phone:</strong> +81-90-8099-1615<br>
        <strong>Email:</strong> info@icarjapan.com<br>
        <strong>Whatsapp:</strong> +81-90-8099-1615<br>
        <strong>Website:</strong> <a href="https://icarjapan.com">www.icarjapan.com</a><br>
        <strong>FB:</strong> <a href="https://www.facebook.com/icarjapanofficial">icarjapanofficial</a>
    </p>
</body>
</html>
