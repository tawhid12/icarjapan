        <!-- left row 5 -->
        <div class="left-row left-row-5 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">Search By Price</h5>
            <div class="card-body">
              @php
              /*for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 500) { */
                @endphp
                {{--<p class="card-text">
                  <i class="bi bi-currency-dollar"></i> Under USD $i
                </p>--}}
                @php
                //}
                @endphp
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=500&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Under USD 500</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=1000&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Under USD 1000</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=2000&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Under USD 2000</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=300&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Under USD 3000</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=4000&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Under USD 4000</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?from_price=5000&type=>" style="text-decoration: none;color:#000;"><i class="bi bi-currency-dollar"></i> Over USD 5000</a></p>
            </div>
          </div>
        </div>