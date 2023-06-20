<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> this line may use if css is not working-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicle query </title>
    <style type="text/css" media="all">
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: "HelveticaNeue-CondensedBold", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }

    </style>
</head>
<body>
    <h4>Inquiry Received</h4>
    <div class="wrapper" style="display:flex;">
        <table style="width:50%;boder:1px solid #000;">
            <tr><th colspan="4">Inquiry Details</th</tr>
            <tr>
                <td><strong>Name:{{$inquiry->name}}</strong></td>
                <td><strong>Email:{{$inquiry->email}}</strong></td>
                <td><strong>Email:{{$inquiry->phone}}</strong></td>
                <td><strong>Email:{{$inquiry->remarks}}</strong></td>
            </tr>
        </table>
        <table style="width:50%;boder:1px solid #000;">
            <tr><th colspan="3">Vehicle Details</th</tr>
            <tr>
                <td><strong>Vehicle Name:{{$v_data->name}}</strong></td>
                <td><strong>Stock ID:{{$v_data->stock_id}}</strong></td>
                <td><strong>Email:{{$inquiry->chassis_no}}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
