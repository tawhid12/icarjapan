@php $body_types = \App\Models\Settings\BodyType::withCount('vehicles')->get(); @endphp
<!-- left row 7 -->
<div class="left-row left-row-7 mb-3">
  <div class="card shadow radious-10">
    <h5 class="card-title bg-black text-white">Search By Type</h5>
    <div class="card-body">
      @forelse($body_types as $bt)
      @if($bt->vehicles_count > 0)
      <p class="card-text">
        <a href="vehicle/advance/search/data?body_type={{$bt->id}}" style="text-decoration:none;color:#000;"><i class="bi bi-car-front-fill"></i>{{$bt->name}} ({{$bt->vehicles_count}})</a>
      </p>
      @endif
      @empty
      @endforelse
    </div>
  </div>
</div>