@php 
$inv_loc = \App\Models\Settings\InventoryLocation::all(); 
$inv_loc = DB::table('countries')
    ->whereIn('id', function ($query) {
        $query->select('inv_locatin_id')
            ->distinct()
            ->from('vehicles')
            ->whereNotNull('inv_locatin_id');
    })
    ->get();
    //print_r($inv_loc);die;
@endphp
<!-- left row 4 -->
<div class="left-row left-row-4 mb-3">
    <div class="card shadow radious-10">
        <h5 class="card-title bg-black text-white">
            Search By Inventory Location
        </h5>
        <div class="card-body">
            <p class="card-text">
                @forelse($inv_loc as $inv)
            <p class="card-text">
                <a href="{{url('/vehicle/advance/search/data')}}?inv_locatin_id={{$inv->id}}" style="text-decoration:none;color:#000;">
                    {{$inv->name}}
                </a>
            </p>
            @empty
            @endforelse
            </p>
        </div>
    </div>
</div>