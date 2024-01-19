<!DOCTYPE html>
<html lang="en">

<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> this line may use if css is not working-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@if($inv->invoice_type ==1) Proforma @else Final @endif Invoice Details</title>

    <style type="text/css" media="all">
        body {
            margin: 0;
        }

        @page {
            size: A4;
            margin: 20;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        tr,
        th,
        td {
            font-size: 13px;
            border: 1px solid #999;
        }
        input{
            height: 20px;
        }
    </style>
</head>

<body>
    <div class="section">
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div style="background-image:url({{ asset('assets/images/logo/header-logo.png')}});width:320px;height:220px;background-repeat:no-repeat; background-size: contain;transform: rotate(317deg);opacity:0.1;position: absolute;top:55%;left:32%;"></div>
                    <table>
                        <thead>
                            <tr class="text-center">
                                <th colspan="4" style="font-size: 12px;color:#000">
                                    <img src="{{ asset('assets/images/logo/header-logo.png')}}" alt="Logo">
                                    <p class="m-0">(WORLD WIDE USED VECHICLES AND PARTS SUPPLIER)</p>
                                    <p class="m-0"><i class="px-2 bi bi-house"></i>{{$com_info->c_address}} <span><i class="px-2 bi bi-telephone"></i>{{$com_info->tel}}</span></p>
                                    <p class="m-0">
                                        <span><i class="px-2 bi bi-whatsapp"></i>{{$com_info->whatsup}}</span>
                                        <span><i class="px-2 bi bi-telephone"></i>{{$com_info->email}}</span>
                                        <span><i class="px-2 bi bi-globe"></i>{{$com_info->website}}</span>
                                    </p>
                                </th>
                            </tr>
                            <tr style="background-color: #C00000;">
                                <th colspan="4" class="text-center py-1" style="color:#fff;font-size:14px;">@if($inv->invoice_type ==1) Proforma @else Final @endif Invoice</th>
                            </tr>
                            <tr>
                                <th>CUSTOMER / BUSINESS NAME:</th>
                                <th>{{$client_data->name}}</th>
                                <th>DATE :</th>
                                <th>{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->invoice_date))->format('d/m/Y')}}</th>
                            </tr>
                            <tr>
                                <th width="120px">CUSTOMER ADDRESS:</th>
                                <th>{{$client_details->address1}}</th>
                                <th>INVOICE NO :</th>
                                <th>ICJ{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->created_at))->format('Ymd')}}{{$inv->id}}</th>
                            </tr>

                            @if($shipment)
                            @php $consignee = \DB::table('consignee_details')->where('id',$shipment->consignee_id)->first(); @endphp
                            @if($consignee)
                            <tr>
                                <th>CONSIGNEE NAME :</th>
                                <th>{{$consignee->c_name}}</th>
                                <th>PORT OF LOADING :</th>
                                <th>
                                    @if($shipment->dep_port_id)
                                    {{DB::table('ports')->where('id',$shipment->dep_port_id)->first()->name}}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th>CONSIGNEE ADDRESS:</th>
                                <th>{{$consignee->c_address}}</th>
                                <th width="160px;">PORT OF DISCHARGE:</th>
                                <th>
                                    @if($shipment->des_port_id)
                                    {{DB::table('ports')->where('id',$shipment->des_port_id)->first()->name}}
                                    @endif
                                </th>
                            </tr>
                            @endif
                            @endif
                            <tr>
                                <th>Country:</th>
                                <th>
                                    @if(DB::table('countries')->where('id',$client_data->country_id)->first())
                                    {{DB::table('countries')->where('id',$client_data->country_id)->first()->name}}
                                    @endif
                                </th>
                                <th width="140px">Agent Name:</th>
                                <th>
                                    @if(DB::table('users')->where('id',$client_data->executiveId)->first())
                                    {{DB::table('users')->where('id',$client_data->executiveId)->first()->name}}
                                    @endif
                                </th>
                            </tr>
                            <tr style="background-color: #C00000;text-align:center;">
                                <th style="font-size:14px;color:#fff;" rowspan="2">IMPORTANT NOTICE</th>
                                <th colspan="3" style="font-size:12px;color:#fff;"><small> MENTION BELOW INFORMATION ON THE TT SLIP</small></th>
                            </tr>
                            <tr style="background-color: #C00000;">
                                <th colspan="3" style="font-size:12px;color:#fff;">
                                    <p class="d-flex justify-content-between" style="">
                                        <span><i class="mx-2 bi bi-gear"></i>INVOICE NO</span>
                                        <span><i class="mx-2 bi bi-gear"></i>REMITTER NAME</span>
                                        <span><i class="mx-2 bi bi-gear"></i>CUSTOMER NAME</span>
                                    </p>
                                </th>
                            </tr>
                            <tr style="background-color:#BFBFBF">
                                <th colspan="2">
                                    <p>Bank Information</p>
                                </th>
                                <th colspan="2">
                                    <p>Account Number</p>
                                </th>
                            </tr>
                            <tr>
                                <th>BANK NAME</th>
                                <th>{{$account_info->bank_name}}</th>
                                <th rowspan="2" colspan="2" style="font-size:22px;color:#203764;background-color:#BFBFBF">{{$account_info->account_number}}</th>
                            </tr>
                            <tr>
                                <th>BANK ADDRESS</td>
                                <th width="300px">{{$account_info->bank_address}}</th>
                            </tr>
                            <tr>
                                <th>BENEFICIARY NAME</td>
                                <th colspan="3">{{$account_info->beni_name}}</th>
                            </tr>
                            <tr>
                                <th>BENEFICIARY ADDRESS</td>
                                <th colspan="3">{{$account_info->c_address}}</th>
                            </tr>
                            <tr>
                                <th>SWIFT CODE</td>
                                <th colspan="3">{{$account_info->swift_code}}</th>
                            </tr>
                            <tr>
                                <th>BRANCH NAME</td>
                                <th colspan="3">{{$account_info->branch_name}}</th>
                            </tr>
                            <tr>
                                <th>BRANCH CODE</td>
                                <th colspan="3">{{$account_info->bank_code}}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">TMT CORPORATION CO,.LTD. & I CAR JAPAN IS A JOINT VENTURE COMPANY. ALL FINANCIAL TRANSACTION OF ICAR JAPAN IS OPERATED BY TMT CORPORATION CO,.LTD.</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">TERMS OF CONDITION: CFR-USD</th>
                            </tr>
                            <tr>
                                <th colspan="2">PLEASE TRANSFER THE FULL AMOUNT TO LOCAL BANK</th>
                                <th>TOTAL @if($inv->invoice_type ==1) CNF @else Due @endif</th>
                                <th style="background-color:#FFC000">{{$inv->inv_amount}}</th>
                            </tr>
                            <tr>
                                <td class="d-flex" colspan="2">
                                    <div style="background-image:url({{ asset('assets/images/logo/company_seal.png')}});width:58px;height:58px;background-repeat:no-repeat; background-size: contain;"></div>
                                    <div style="background-image:url({{ asset('assets/images/logo/corp_seal.png')}});width:200px;height:58px;background-repeat:no-repeat; background-size: contain;"></div>
                                </td>
                                @if($inv->invoice_type ==1)
                                <th class="text-right">REQUIRED DEPOSIT</th>
                                <td style="font-size: 12px;color:#000;"><b>{{$v->required_deposit}}</b></td>
                                @endif
                            </tr>
                            <tr>
                                <th colspan="4">TMT CORPORATION</th>
                            </tr>
                            <tr>
                                <th><small>PAYMENT DUE ON:</small></th>
                                <th colspan="3" style="background-color:#FFC000">*BANK CHARGE MUST BE BEARED BY REMITTER*</th>
                            </tr>
                            <tr>
                                <th colspan="4">TOTAL UNIT(s):</th>
                            </tr>
                        </thead>
                    </table>
                    <table>
                        <tr style="background-color: #C00000;">
                            <th style="color:#fff">SL NO</th>
                            <th colspan="2" style="color:#fff">CAR BASIC INFORMATION</th>
                            <th colspan="2" style="color:#fff">ADDITIONAL INFORMATION</th>
                            <th style="color:#fff">AMOUNT BREAKDOWN</th>
                        </tr>

                        <tr valign="middle" class="text-center">
                            <th rowspan="6">1</th>
                        </tr>
                        <tr>
                            <th>Maker :</th>
                            <th>{{$v->bName}}</th>

                            <th>Fuel:</th>
                            <th>{{$v->fName}}</th>

                            <th rowspan="3">CURRENCY: USD</th>
                        </tr>
                        <tr>
                            <th>Car Name :</th>
                            <th>{{$v->fullName}}</th>

                            <th>Steering :</th>
                            <th>@if($v->steering == 1) Auto @else Manual @endif</th>

                        </tr>
                        <tr>
                            <th>Chassis :</th>
                            <th>{{$v->chassis_no}}</th>

                            <th>Transmission:</th>
                            <th>{{$v->tName}}</th>

                        </tr>
                        <tr>
                            <th>Manufacture Year:</th>
                            <th>{{$v->manu_year}}</th>

                            <th>Engine:</th>
                            <th>{{$v->e_size}}</th>

                            <th rowspan="2">Price</th>
                        </tr>
                        <tr>
                            <th>Body Type:</th>
                            <th>{{$v->btName}}</th>

                            <th>Mileage: (Km)</th>
                            <th>{{$v->mileage}}</th>

                        </tr>


                        <tr style="background-color: #C00000;">
                            <th colspan="5" style="color:#fff;">TOTAL CNF</th>
                            <th style="color:#fff">{{$inv->inv_amount}}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>