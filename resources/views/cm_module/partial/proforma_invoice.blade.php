@include('layout.message')
@if(!empty($resrv))
<div class="border">
    <div class="p-2">
        <h5 class="text-center my-2 pb-2">Proforma Invoice</h5>
        @forelse($resrv as $pro_inv)
        @empty
        @endforelse
    </div>
</div>
@endif