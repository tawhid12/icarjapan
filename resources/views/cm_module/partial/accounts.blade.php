<div class="border p-2">
    <h5 class="text-center border-bottom my-3">Payment Summary</h5>
    <table class="table table-bordered m-0">
        <tr>
            <th>Currency</th>
            <th>Payment Total</th>
            <th>Allocated Total</th>
            <th>Deposit Total</th>
            <th>Security Deposit Total</th>
            <th>Due Amount</th>
        </tr>
        <tr>
            <td>USD</td>
            <td>
                @if(\DB::table('payments')->where('client_id',$client_data->id)->sum('amount'))
                {{\DB::table('payments')->where('client_id',$client_data->id)->sum('amount')}}
                @endif
            </td>
            <td>{{DB::table('reserved_vehicles')->where('user_id',$client_data->id)->sum('allocated')}}</td>
            <td>{{\DB::table('deposits')->where('client_id',$client_data->id)->selectRaw('SUM(COALESCE(deposit_amt,0) + COALESCE(deduction,0)) as total_sum')->value('total_sum')}}</td>
            <td>-</td>
            <td>{{\DB::table('invoices')->where('client_id',$client_data->id)->where('invoice_type',4)->sum('inv_amount')-\DB::table('payments')->where('client_id',$client_data->id)->sum('amount')}}</td>
        </tr>
    </table>
    <h5 class="my-2">Payment History</h5>
    <table class="table table-bordered m-0">
        <tr>
            <th>Received Date</th>
            <th>Currency</th>
            <th>Invoice ID</th>
            <th>Amount</th>
            <th>Amount in USD</th>
            <th>Deposit Ratio</th>
            <th>Deposit Count</th>
            <th>Balance Count</th>
            <th>Payment ID</th>
        </tr>
        @forelse($invoices as $inv)
        <tr>
            <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->invoice_date))->format('d/m/Y')}}</td>
            <td>USD</td>
            <td>ICJ{{\Carbon\Carbon::createFromTimestamp(strtotime($inv->created_at))->format('Ymd')}}{{$inv->id}}</td>
            <td>{{\DB::table('payments')->where('invoice_id',$inv->id)->first()->amount}}</td>
            <td>{{\DB::table('payments')->where('invoice_id',$inv->id)->first()->amount}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{\DB::table('payments')->where('invoice_id',$inv->id)->first()->id}}</td>
            
        </tr>
        @empty
        @endforelse
    </table>

    <!-- <h4>Payments</h4>
    <table class="table table-bordered m-0">
        <tr>
            <th>Invoice Id</th>
            <th>Reserve Information</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
        @forelse($payments as $p)
        <tr>
            <td>{{$p->invoice_id}}</td>
            <td>{{$p->reserve_id}}</td>
            <td>{{$p->receive_date}}</td>
            <td>{{$p->amount}}</td>
        </tr>
        @empty
        @endforelse
    </table> -->

    <h5 class="my-2">Deposit</h5>
    <table class="table table-bordered m-0">
        <tr>
            <th>Deposit Type</th>
            <th>Deposit Amount</th>
            <th>Date</th>
        </tr>
        @forelse($deposits as $d)
        <tr>
            <td>{{$d->deposit_type}}</td>
            <td>{{$d->deposit_amt}}</td>
            <td>{{$d->deposit_date}}</td>
        </tr>
        @empty
        @endforelse
    </table>
</div>