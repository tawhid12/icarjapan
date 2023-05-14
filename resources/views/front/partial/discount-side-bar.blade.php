        <!-- left row 6 -->
        <div class="left-row left-row-6 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-black">
              Search By Discount
            </h5>
            <div class="card-body">
              @php
              for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) {
                @endphp
                <p class="card-text">
                  <i class="bi bi-funnel"></i> Up to {{$i}}%
                </p>
                @php
                }
                @endphp
            </div>
          </div>
        </div>