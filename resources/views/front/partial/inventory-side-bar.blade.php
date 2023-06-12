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
                        <a href="" style="text-decoration:none;color:#000;">
                        {{optional($inv->country)->name}}
                        </a>
                    </p>
                    @empty
                    @endforelse
                    </p>
                </div>
            </div>
        </div>