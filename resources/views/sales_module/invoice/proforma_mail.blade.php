<!DOCTYPE html>
<html lang="en">

<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> this line may use if css is not working-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@if($inv->invoice_type ==1) Proforma @else Final @endif Invoice Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style type="text/css" media="all">
         @font-face {
            font-family: 'Carlito';
            src: url('{{ public_path("fonts/ttf/carlito/Carlito-Regular.ttf") }}') format("truetype");
            font-weight: normal;
        }
        @font-face {
            font-family: 'Carlito';
            src: url('{{ public_path("fonts/ttf/carlito/Carlito-Bold.ttf") }}') format("truetype");
            font-weight: bold;
        }
        @font-face {
            font-family: 'Noto Sans JP';
            font-style: normal;
            font-weight: 400;
            src: url('{{ public_path("fonts/noto-sans-jp/NotoSansJP-Regular.ttf") }}') format('truetype');
        }
        @font-face {
            font-family: 'Noto Sans JP';
            font-style: bold;
            font-weight: 700;
            src: url('{{ public_path("fonts/noto-sans-jp/NotoSansJP-Bold.ttf") }}') format('truetype');
        }
        body {
            margin: 0;
            font-family: 'Carlito', sans-serif;
            font-family: 'Noto Sans JP', sans-serif;
            font-size:10px;
            line-height:1;
        }

        @page {
            size: A4;
            margin: 20;
        }
        table {
            /*border-collapse: collapse;*/
            width: 100%;
            /*table-layout: fixed;*/  /* Ensures table columns remain fixed width */
            font-family: 'Carlito', sans-serif;
            font-family: 'Noto Sans JP', sans-serif;
        }
        th, td {
            padding: 4px;  /* Adjust padding to avoid excessive space */
            text-align: left;
            word-wrap: break-word; /* Avoid text overflow */
            font-size:9px;
            font-family: 'Carlito', sans-serif;
            font-family: 'Noto Sans JP', sans-serif;
        }

        p{
            margin:0;
            font-size:10px;
            font-family: 'Carlito', sans-serif;
            font-family: 'Noto Sans JP', sans-serif;
        }
        table,
        tr,
        th,
        td {
            /*border: 1px solid #999;*/
            font-family: 'Carlito', sans-serif;
            font-family: 'Noto Sans JP', sans-serif;
        }
        input{
            height: 20px;
        }
        .stamp {
          display: inline-block;
          color: red;
          font-weight: bold;
          font-size: 24px;
          border: 4px solid red;
          padding: 10px 20px;
          border-radius: 8px;
          transform: rotate(-10deg);
          text-transform: uppercase;
          font-family: 'Arial Black', sans-serif;
          box-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="section">
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div style="background-image:url({{ asset('assets/images/logo/header-logo.png')}});width:320px;height:220px;background-repeat:no-repeat; background-size: contain;transform: rotate(317deg);opacity:0.1;position: absolute;top:55%;left:32%;"></div>
                    <table align="center" style="width: 600px; border: none; margin: 0 auto;">
    <tr>
        <!-- Logo Column -->
        <td style="width: 100px; text-align: center; vertical-align: middle; border: none;">
            <img src="{{ asset('assets/images/logo/header-logo2.png') }}" alt="Logo" style="height: 60px;">
        </td>

        <!-- Info Column -->
        <td style="text-align: left; vertical-align: middle; border: none;">
            <p style="margin: 0; font-weight: bold; font-size: 20px; font-family: Arial, sans-serif;">
                <span style="color: red;">I CAR</span> <span style="color: black;">JAPAN</span>
            </p>
            <p style="margin: 0;">(WORLD WIDE USED VEHICLES AND PARTS SUPPLIER)</p>
            <p style="margin: 2px 0;">{{ $com_info->c_address }} ☎ {{ $com_info->tel }}</p>
            <p style="margin: 0;">
                <i class="fas fa-comment-dots"></i> {{ $com_info->whatsup }} &nbsp;
                <i class="fas fa-envelope"></i> {{ $com_info->email }} &nbsp;
                <i class="fas fa-globe"></i> {{ $com_info->website }}
            </p>
        </td>
    </tr>
</table>


                    <table>
                            <tr style="background-color: #C00000;">
                                {{--<th colspan="4" style="color:#fff;font-size:11px;padding:6px 0;text-align:center;">@if($inv->invoice_type ==1) PROFORMA @else FINAL @endif INVOICE</th>--}}
                                <th colspan="4" style="color:#fff;font-size:11px;padding:6px 0;text-align:center;">@if($payment->sum('amount') == $v->total ) FINAL @elseif($payment->sum('amount') == 0) PROFORMA @else DUE @endif INVOICE</th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">CUSTOMER / BUSINESS NAME:</th>
                                <th style="width: 40%;">{{$client_data->name}}</th>
                                <th style="width: 15%;">DATE:</th>
                                {{--<th style="width: 15%;">{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->invoice_date))->format('d/m/Y')}}</th>--}}
                                <th style="width: 15%;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">CUSTOMER ADDRESS:</th>
                                <th style="width: 40%;">{{$client_details->address1}}</th>
                                <th style="width: 15%;">INVOICE NO :</th>
                                <th style="width: 15%;">ICJ{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->created_at))->format('Ymd')}}{{$inv->id}}</th>
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
                               <th style="width: 15%;">Port Of Discharge</th>
                                <th style="width: 15%;"> {{DB::table('ports')->where('id',$client_data->port_id)->first()->name}}</th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Ship Via:</th>
                                <th style="width: 40%;">Roro/Container</th>
                                <th width="140px">Agent Name:</th>
                                <th>
                                    @if(DB::table('users')->where('id',$client_data->executiveId)->first())
                                    {{DB::table('users')->where('id',$client_data->executiveId)->first()->name}}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Port Of Loading:</th>
                                <th style="width: 40%;">Any,Japan</th>
                                <th style="width: 30%;">CM ID:</th>
                                <th style="width: 40%;">{{$client_data->id}}</th>
                            </tr>
                        </table>
                    <table>
                            <tr style="background-color: #C00000; text-align: center;">
                                <th style="font-size:14px; color:#fff; width: 328px; vertical-align: middle;text-align:center;">
                                    IMPORTANT NOTICE
                                </th>
                                <th style="font-size:12px; color:#fff; text-align:center;">
                                    <div><small>MENTION BELOW INFORMATION ON THE TT SLIP</small></div>
                                    <div style="font-size:14px;"><i class="fas fa-cog"></i> INVOICE NO <i class="fas fa-cog"></i> REMITTER NAME <i class="fas fa-cog"></i> CUSTOMER NAME</div>
                                </th>
                            </tr>
                        </table>
                    <table>
                            <tr style="background-color:#BFBFBF">
                                <th colspan="3" style="text-align:center;">Bank Information</th>
                                <th style="text-align:center; width: 150px;">Account Number</th>
                            </tr>
                            <tr>
                                <th>BANK NAME</th>
                                <th colspan="2">{{ $account_info->bank_name }}</th>
                                <th rowspan="2" style="font-size:14px; text-align:center;color:#203764; background-color:#BFBFBF; width:150px; word-wrap:break-word; overflow-wrap:break-word;">
                                    {{ $account_info->account_number }}
                                </th>
                            </tr>
                            <tr>
                                <th>BANK ADDRESS</th>
                                <th colspan="2" style="width:300px;">{{ $account_info->bank_address }}</th>
                            </tr>
                            <tr>
                                <th>BENEFICIARY NAME</th>
                                <th colspan="3">{{ $account_info->beni_name }}</th>
                            </tr>
                            <tr>
                                <th>BENEFICIARY ADDRESS</th>
                                <th colspan="3">
                                    {{ $account_info->beni_address }}
                                    <p style="margin:0;">{{ $account_info->beni_address_jap }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>SWIFT CODE</th>
                                <th colspan="3">{{ $account_info->swift_code }}</th>
                            </tr>
                            <tr>
                                <th>BRANCH NAME</th>
                                <th colspan="3">{{ $account_info->branch_name }}</th>
                            </tr>
                            <tr>
                                <th>BRANCH CODE</th>
                                <th colspan="3">{{ $account_info->bank_code }}</th>
                            </tr>
                        </table>
                    <table>
                        <tr style="background-color:#FFB84D;text-align:center;">
                            <th colspan="4" style="#FFB84D;text-align:center;">
                                <p style="margin:0;">TMT CORPORATION CO,.LTD. & I CAR JAPAN IS A JOINT VENTURE COMPANY.</p>
                                <p style="margin:0">ALL FINANCIAL TRANSACTION OF ICAR JAPAN IS OPERATED BY TMT CORPORATION CO,.LTD.</p>
                            </th>
                        </tr>
                    </table>
                    @php $balance = $v->total- $payment->sum('amount'); @endphp
                    
                <table>
                    <tr style="line-height: 1;">
                        <th colspan="3" class="text-center">TERMS OF CONDITION: CFR-USD</th>
                    </tr>
                
                    <!-- Row: Transfer instruction and Total -->
                    <tr style="line-height: 1;">
                        <th colspan="2" style="text-align: left;">PLEASE TRANSFER THE FULL AMOUNT TO LOCAL BANK</th>
                        <th style="text-align: right;">
                            TOTAL @if($inv->invoice_type ==1 || $balance == 0) CNF @else Due @endif
                            <span style="background-color:#FFC000;padding:4px 10px;display:inline-block;">
                                USD {{$inv->inv_amount}}
                            </span>
                        </th>
                    </tr>
                    
                    <!-- Row: Required Deposit, only if CNF -->
                    @if($payment->sum('amount') == 0)
                    <tr style="line-height: 1;">
                        <td colspan="2"></td>
                        <td style="text-align: right;">
                            REQUIRED DEPOSIT
                            <span style="background-color:#FFC000;padding:4px 10px;display:inline-block;">
                                USD {{$v->required_deposit}}
                            </span>
                        </td>
                    </tr>
                    @elseif($balance > 0)
                     <tr style="line-height: 1;">
                        <td colspan="2"></td>
                        <td style="text-align: right;">
                            DUE AMOUNT
                            <span style="background-color:#FFC000;padding:4px 10px;display:inline-block;">
                                USD {{$balance}}
                            </span>
                        </td>
                    </tr>
                    @endif
                
                    <!-- Row: Logos -->
                    <tr style="line-height: 1;">
                        <td colspan="3">
                            <table width="100%">
                                <tr>
                                    <td style="width: 60px;">
                                        <div style="background-image:url('{{ asset('assets/images/logo/company_seal.png') }}');width:48px;height:58px;background-repeat:no-repeat;background-size:contain;"></div>
                                    </td>
                                    <td style="width: 200px;">
                                        <div style="background-image:url('{{ asset('assets/images/logo/corp_seal.png') }}');width:200px;height:48px;background-repeat:no-repeat;background-size:contain;"></div>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                
                    <!-- Row: Footer Info -->
                    <tr style="line-height: 1;">
                        <th colspan="3">TMT CORPORATION</th>
                    </tr>
                    <tr style="line-height: 1;">
                        <th colspan="2"><small>PAYMENT DUE ON:</small></th>
                        <th style="background-color:#FFC000;text-align:right;width:260px;">* BANK CHARGE MUST BE BEARED BY REMITTER *</th>
                    </tr>
                    <tr style="line-height: 1;">
                        <th colspan="3">TOTAL UNIT(s):</th>
                    </tr>
                </table>



                    <table>
                        <tr style="background-color: #C00000;line-height: 1;">
                            <th style="color:#fff">SL NO</th>
                            <th colspan="2" style="color:#fff">CAR BASIC INFORMATION</th>
                            <th colspan="2" style="color:#fff">ADDITIONAL INFORMATION</th>
                            <th style="color:#fff">AMOUNT BREAKDOWN</th>
                        </tr>

                        <tr valign="middle" class="text-center" style="line-height: 1;">
                            <th rowspan="6">1</th>
                        </tr>
                        <tr style="line-height: 1;">
                            <th>Maker & Stock ID:</th>
                            <th>{{$v->bName}} -- {{$v->stock_id}}</th>

                            <th>Fuel:</th>
                            <th>{{$v->fName}}</th>

                            <th>CURRENCY: USD</th>
                        </tr>
                        <tr style="line-height: 1;">
                            <th>Car Name :</th>
                            <th>{{$v->fullName}}</th>

                            <th>Steering :</th>
                            <th>@if($v->steering == 1) Auto @else Manual @endif</th>
                            
                            <th>FOB Amount:{{$v->fob_amt-$v->sp_dis}}</th>
                        </tr>
                        <tr style="line-height: 1;">
                            <th>Chassis :</th>
                            <th>{{$v->chassis_no}}</th>

                            <th>Transmission:</th>
                            <th>{{$v->tName}}</th>
                            <th>Freight Amount:{{($v->m3_value*$v->m3_charge)+$v->aditional_cost}}</th>
                        </tr>
                        <tr style="line-height: 1;">
                            <th>Manufacture Year:</th>
                            <th>{{$v->manu_year}}</th>

                            <th>Engine:</th>
                            <th>{{$v->e_size}}</th>

                            <th rowspan="2">Price</th>
                        </tr>
                        <tr style="line-height: 1;">
                            <th>Body Type:</th>
                            <th>{{$v->btName}}</th>

                            <th>Mileage: (Km)</th>
                            <th>{{$v->mileage}}</th>
                            
                        </tr>


                        <tr style="background-color: #C00000;line-height: 1;">
                            <th colspan="5" style="color:#fff;">TOTAL CNF</th>
                            <th style="color:#fff">USD {{$inv->inv_amount}}</th>
                        </tr>
                        @if($payment->sum('amount') ==0)
                        <tr style="background-color: #FFB84D;line-height: 1;">
                                <th colspan="5" style="color:#000;">REQUIRED DEPOSIT</th>
                                <th style="color:#fff">USD 
                                    @if($v->required_deposit > 0)
                                        {{ $v->required_deposit }}
                                    @else
                                        {{ $inv->inv_amount / 2 }}
                                    @endif
                                </th>
                            </tr>
                            <tr style="background-color: #FFB84D;line-height: 1;">
                                <th colspan="5" style="color:#000;">REMAINING BALANCE</th>
                                <th style="color:#fff">USD 
                                    @if($v->required_deposit > 0)
                                        {{ $inv->inv_amount - $v->required_deposit }}
                                    @else
                                        {{ $inv->inv_amount / 2 }}
                                    @endif
                                </th>
                            </tr>
                        @elseif($payment->sum('amount') < $v->total)
                             <tr style="background-color: #FFB84D;line-height: 1;">
                                <th colspan="5" style="color:#000;">TOTAL DEPOSITED AMOUNT</th>
                                <th style="color:#fff">USD {{ $payment->sum('amount') }}</th>
                            </tr>
                            <tr style="background-color: #FFB84D;line-height: 1;">
                                <th colspan="5" style="color:#000;">DUE AMOUNT</th>
                                <th style="color:#fff">USD {{ $inv->inv_amount - $payment->sum('amount') }}</th>
                            </tr>
                            @else
                            <div class="stamp">PAID IN FULL</div>
                            <br><br>
                        @endif


                    </table>
                </div>
                <!--<div style="page-break-after: always;"></div>-->

<!-- Second Page: Terms and Conditions -->
<div>
    <h2 style="text-align:center;">TERMS AND CONDITIONS</h2>

    <h3>PAYMENT</h3>
    <ul>
        <li>No deposit is required before confirming any vehicle.</li>
        <li>Full or partial payment is required within seven days of confirmation via telegraphic transfer (TT).</li>
        <li>Original Documents will be released and sent via courier service once the balance is paid in full.</li>
        <li>Customers can pay in US Dollars or any other currency.</li>
        <li>Customer must pay the remaining balance within seven days from shipment date. Otherwise, TMT Corporation has the right to re-sell without any notice and no claim will be accepted.</li>
        <li>Prices stated in the Proforma Invoice do not cover any bank charges or additional charges payable to the Bank. All such charges must be borne by the customer.</li>
        <li>Customer must ensure the full amount stated in the Proforma Invoice is received by TMT Corporation.</li>
    </ul>

    <h3>SHIPPING</h3>
    <ul>
        <li>Shipping arrangements will be processed upon receipt of the deposit.</li>
        <li>Shipping cancellation is not accepted once the vehicle(s) have passed Japanese Customs check.</li>
        <li>Shipping duration is estimated. TMT Corporation is not liable for delays caused by shipping issues or port authority issues.</li>
    </ul>

    <h3>MISCELLANEOUS</h3>
    <ul>
        <li>Customers must be aware of the import regulations and requirements before finalizing transactions.</li>
        <li>TMT Corporation does not provide services such as oil or radiator coolant refill.</li>
        <li>Customers should check and refill oil and coolant at their own expense after receiving the vehicle at the port.</li>
    </ul>

    <h3>SECURITY TRADE CONTROL</h3>
    <ul>
        <li>TMT Corporation complies with all applicable national and international laws, rules, and regulations related to export control, international peace, and anti-terrorism.</li>
        <li>We observe List Controls, Catch-All Controls, and prevent development or manufacture of weapons.</li>
    </ul>

    <p style="text-align:center; margin-top:50px;">
        <strong>ICAR JAPAN & TMT CORPORATION CO.,LTD.</strong><br>
        934-0027 Toyama-Ken, Imizu-shi, Nakashinminato 17-1, 715 Japan
    </p>
</div>
            </div>
        </div>
    </div>
</body>

</html>