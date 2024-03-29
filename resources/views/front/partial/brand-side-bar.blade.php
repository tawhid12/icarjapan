@php $brands = \App\Models\Vehicle\Brand::withCount('vehicles')->get(); @endphp
<!-- left row 3 -->
<div class="left-row left-row-3 mb-3">
    <div class="card shadow radious-10">
        <h5 class="card-title bg-black text-white">Search by Brands</h5>
        <div class="card-body">
            @forelse($brands as $b)
            @if($b->vehicles_count > 0)
            <p class="card-text">
                <a href="{{route('brand',strtolower($b->slug_name))}}?search=brand" style="text-decoration:none;color:#000;">
                @if(!empty($b->image))

                <img src="{{route('resizeImage',['brands',$b->image,18,26])}}" alt="" />
                @endif
                 {{$b->name}} ({{$b->vehicles_count}})</a>
            </p>
            @endif
            @empty
            @endforelse
        </div>
    </div>
</div>