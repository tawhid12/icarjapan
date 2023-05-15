        <!-- left row 5 -->
        <div class="left-row left-row-5 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">Search By Price</h5>
            <div class="card-body">
              @php
              for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 500) {
                @endphp
                <p class="card-text">
                  <i class="bi bi-currency-dollar"></i> Under USD {{$i}}
                </p>
                @php
                }
                @endphp
            </div>
          </div>
        </div>