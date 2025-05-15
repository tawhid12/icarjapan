@php  
$trans = \App\Models\Vehicle\Transmission::all(); 
$drive_types = \App\Models\Settings\DriveType::all();
@endphp
<!-- left row 8 -->
        <div class="left-row left-row-8 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">
              Search By Category
            </h5>
            <div class="card-body">
              @forelse($drive_types as $dt)
              <p class="card-text">
                   <a class="nav-link" href="{{url('/')}}/vehicle/advance/search/data?drive_id={{$dt->id}}"><i class="bi bi-car-front-fill"></i>{{$dt->name}}</a>
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </div>