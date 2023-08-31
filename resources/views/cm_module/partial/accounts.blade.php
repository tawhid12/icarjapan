<div class="border p-2">
    <h5 class="text-center border-bottom my-3">Account's Information</h5>
    <h4>Invoice</h4>
    <table class="table table-bordered m-0">
        <tr>
            <th>Reserve Information</th>
            <th>Vehicle Information</th>
            <th>Invoice Type</th>
            <th>Date</th>
            <th>Invoice Amount</th>
        </tr>
        @forelse($invoices as $inv)
        <tr>
            <td>{{$inv->reserve_id}}</td>
            <td>{{$inv->vehicle_id}}</td>
            <td>{{$inv->invoice_type}}</td>
            <td>{{$inv->invoice_date}}</td>
            <td>{{$inv->inv_amount}}</td>
        </tr>
        @empty
        @endforelse
    </table>

    <h4>Payments</h4>
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
    </table>

    <h4>Deposit</h4>
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