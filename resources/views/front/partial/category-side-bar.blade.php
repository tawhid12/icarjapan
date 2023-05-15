        <!-- left row 8 -->
        <div class="left-row left-row-8 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">
              Search By Category
            </h5>
            <div class="card-body">
              @forelse($trans as $t)
              <p class="card-text">
                <i class="bi bi-arrows-move"></i>{{$t->name}} ({{$t->vehicles_count}})
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </div>