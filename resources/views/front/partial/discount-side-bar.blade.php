        <!-- left row 6 -->
        <div class="left-row left-row-6 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">
              Search By Discount
            </h5>
            <div class="card-body">
              @php
              /*for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) { */
                @endphp
                <!--<p class="card-text">
                  <i class="bi bi-funnel"></i> Up to {{--$i--}}%
                </p>-->
                @php
                //}
                @endphp
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=90&type=<" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>90%~ Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=80&discount_to=89" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>80%~89% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=70&discount_to=79" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>70%~79% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=60&discount_to=69" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>60%~69% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=50&discount_to=59" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>50%~59% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=40&discount_to=49" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>40%~49% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=30&discount_to=39" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>30%~39% Off</a></p>
                <p class="card-text"><a href="vehicle/advance/search/data?discount_from=1&discount_to=29" style="text-decoration: none;color:#000;"><i class="bi bi-funnel"></i>1%~29% Off</a></p>
            </div>
          </div>
        </div>