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
        table,tr,th,td{
            border:1px solid #000;
        }
    </style>
</head>
<body>
    <h4>Inquiry From User</h4>
    <div class="wrapper" style="display:flex;justify-content:space-between;">
        <table style="width:80%;">
            <tr><th colspan="4">Inquiry Details</th</tr>
            <tr>
                <td><strong>Name:{{$inquiry->name}}</strong></td>
                <td><strong>Email:{{$inquiry->email}}</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Phone:{{$inquiry->phone}}</strong></td>
            </tr>
            <tr>
                <td>
                    <strong>
                    @if($type == 1)
                    User Query
                    @else
                    Replied
                    @endif
                    </strong>
                </td>
                <td>
                    <strong>
                    @if($type == 1)
                    Inquiry:{{$inquiry->remarks}}
                    @else
                    Replied:{{$inquiry->remarks}}
                    @endif
                    </strong>
                </td>
            </tr>
        </table>
        <table style="width:80%;border:1px solid #000;">
            <tr><th>Vehicle Details</th</tr>
            <tr>
                <td>
                    <strong>Vehicle Name:{{$v_data->name}}</strong>
                    <p>Country:{{$inquiry->country?->name}}</p>
                </td>
            </tr>
            <tr>
                <td><strong>Stock ID:{{$v_data->stock_id}}</strong></td>
            </tr>
            <tr>
                <td><strong>Chasis No:{{$inquiry->chassis_no}}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
