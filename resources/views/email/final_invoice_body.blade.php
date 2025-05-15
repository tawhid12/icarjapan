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

    <p>Please find attached the final invoice pertaining to the export of the vehicle(s) as per the terms of our agreement. </p>

    <p><strong>Invoice Summary:</strong></p>
    <p>
        <strong>CUSTOMER NAME:</strong> {{ $client_data->name }}<br>
        <strong>Invoice No:</strong> ICJ{{ \Carbon\Carbon::parse($inv->created_at)->format('Ymd') }}{{ $inv->id }}<br>
        <strong>Vehicle(s) Stock ID:</strong> {{ $v->stock_id }}<br>
        <strong>Total CNF:</strong> USD {{ number_format($inv->inv_amount, 2) }}<br>
        <strong>Issue Date:</strong> {{ \Carbon\Carbon::parse($inv->created_at)->format('F j, Y') }}<br>
        <strong>Destination Country:</strong> {{ DB::table('countries')->where('id', $client_data->country_id)->first()->name }}<br>
        <strong>Destination Port:</strong> {{ DB::table('ports')->where('id', $client_data->port_id)->first()->name }}
    </p>
    <p>Please review the attached invoice as soon as possible. If you have any questions or require further clarification, please do not hesitate to contact us.</p>
    <p><strong>We would like to take this opportunity to express our sincere appreciation for your business and look forward to the possibility of working together again.</strong></p>
    
    <br><br>
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
