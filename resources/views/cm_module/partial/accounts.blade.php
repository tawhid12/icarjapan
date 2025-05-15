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
                @if(\DB::table('payments')->where('client_id',$client_data->id)->first())
                {{\DB::table('payments')->where('client_id',$client_data->id)->sum('amount')}}
                @endif
            </td>
            <td>
                @if(DB::table('reserved_vehicles')->where('user_id',$client_data->id)->first())
                {{\DB::table('reserved_vehicles')->where('user_id',$client_data->id)->sum('allocated')}}
                @endif
            </td>
            <td>{{\DB::table('deposits')->where('client_id',$client_data->id)->selectRaw('SUM(COALESCE(deposit_amt,0) + COALESCE(deduction,0)) as total_sum')->value('total_sum')}}</td>
            <td>-</td>
            <td>
                @if(\DB::table('invoices')->where('client_id',$client_data->id)->where('invoice_type',4)->first() && \DB::table('payments')->where('client_id',$client_data->id)->first())
                {{\DB::table('invoices')->where('client_id',$client_data->id)->where('invoice_type',4)->sum('inv_amount')-\DB::table('payments')->where('client_id',$client_data->id)->sum('amount')}}
                @endif
            </td>
        </tr>
    </table>
    {{--<h5 class="my-2">Payment History</h5>
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
            <td>
                @if(\DB::table('payments')->where('invoice_id',$inv->id)->first())
                {{\DB::table('payments')->where('invoice_id',$inv->id)->first()->amount}}
                @endif
            </td>
            <td>
                @if(\DB::table('payments')->where('invoice_id',$inv->id)->first())
                {{\DB::table('payments')->where('invoice_id',$inv->id)->first()->amount}}
                @endif
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @if(\DB::table('payments')->where('invoice_id',$inv->id)->first())
                {{\DB::table('payments')->where('invoice_id',$inv->id)->first()->id}}
                @endif
            </td>
            
        </tr>
        @empty
        @endforelse
    </table>--}}

    <h4>Payment History</h4>
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
            <!--<th>Payment ID</th>-->
            @if(currentUser() == 'superadmin')
            <th>Action</th>
            @endif
        </tr>
        @forelse($payments as $p)
        <tr>
            <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($p->receive_date))->format('d/m/Y')}}</td>
            <td>USD</td>
            <!--<td>ICJ{{\Carbon\Carbon::createFromTimestamp(strtotime($p->created_at))->format('Ymd')}}{{$p->invoice_id}}</td>-->
            <td>{{$p->invoice_no}}</td>
            <td>{{$p->amount}}</td>
            <td>{{$p->amount}}</td>
            <td></td>
            <td></td>
            <td></td>
            <!--<td>{{$p->id}}</td>-->
            @if(currentUser() == 'superadmin')
                <td>
                    <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete this item?')) { $('#form{{$p->id}}').submit(); }">
                        <i class="bi bi-trash"></i>
                    </a>
                    <form id="form{{$p->id}}" action="{{ route(currentUser().'.payment.destroy', encryptor('encrypt', $p->id)) }}" method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                </td>
             @endif
        </tr>
        @empty
        @endforelse
    </table>

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