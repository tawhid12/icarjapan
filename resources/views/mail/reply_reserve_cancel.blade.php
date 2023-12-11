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
    <div class="wrapper">
        <h4>Your Favourite Vehicle Now Available in Stock</h4>
        <p>
            Dear <strong>{{$user->name}}</strong>,
        </p>
        <p>Reserved Free For <strong>{{$v_data->name}} </strong>and Stock Id <strong>{{$v_data->stock_id}}</strong>
    </div>
</body>
</html>
