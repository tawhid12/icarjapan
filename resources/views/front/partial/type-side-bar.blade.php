        <!-- left row 7 -->
        <div class="left-row left-row-7 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-black">Search By Type</h5>
            <div class="card-body">
              @forelse($body_types as $bt)
              <p class="card-text">
                <a href="" style="text-decoration:none;color:#000;"><i class="bi bi-car-front-fill"></i>{{$bt->name}} ({{$bt->vehicles_count}})</a>
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>