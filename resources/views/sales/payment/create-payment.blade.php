  @extends('layout.app')

  @section('pageTitle','Make Payment')
  @section('pageSubTitle','Payment')

  @section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.payment.store')}}">
                              @csrf
                              <div class="row">
                                  <div class="col-md-3 col-12">
                                      <p class="m-0"><strong>Customer Name : {{optional($invoice->user)->name}} <br> Customer ID :{{$invoice->client_id}}</strong></p>
                                  </div>
                                  <div class="col-md-2 col-12">
                                      <p class="m-0"><strong>Invoice No : {{$invoice->id}}</strong></p>
                                  </div>
                                  <div class="col-md-2 col-12">
                                      <p class="m-0"><strong>Invoice Amount : {{$invoice->inv_amount}}</strong></p>
                                  </div>
                                  <div class="col-md-2 col-12">
                                      <p class="m-0"><strong>Due Amount : {{$invoice->inv_amount-\DB::table('payments')->where('reserve_id',$invoice->reserve_id)->sum('amount')}}</strong></p>
                                  </div>
                                  <div class="col-md-2 col-12">
                                      <p class="m-0"><strong>Deposit Available : {{\DB::table('deposits')->where('client_id',$invoice->client_id) ->selectRaw('SUM(COALESCE(deposit_amt,0) + COALESCE(deduction,0)) as total_sum')->value('total_sum');}}</strong></p>
                                  </div>
                                  
                                  <hr>
                                  <input type="hidden" value="{{$invoice->client_id}}" name="client_id">
                                  <input type="hidden" value="{{$invoice->id}}" name="invoice_id">
                                  <input type="hidden" value="{{$invoice->reserve_id}}" name="reserve_id">
                                  <input type="hidden" value="{{\DB::table('deposits')->where('client_id',$invoice->client_id)->sum('deposit_amt')}}" name="deduction">
                                  <input type="hidden" value="{{$id}}" name="payment_id">
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="type">Payment Type</label>
                                          <select name="type" class="form-control">
                                              <!-- <option value="">Select</option> -->
                                              <option value="1" selected>Regular</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="currency_type">Currency</label>
                                          <select name="currency_type" class="form-control">
                                              <option value="">Select</option>
                                              <option value="1" selected>USD</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="receive_date">Receive Date</label>
                                          <input type="text" id="receive_date" class="form-control" name="receive_date">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="amount">Amount</label>
                                          <input type="text" id="amount" class="form-control" placeholder="Amount" name="amount" required>
                                      </div>
                                  </div>
                                  {{--value="optional($invoice->res_vehicle)->settle_price"--}}
                                  <!-- <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="allocated">Allocated</label>
                                          <input type="text" id="allocated" class="form-control" placeholder="Allocated" name="allocated">
                                      </div>
                                  </div> -->
                              </div>
                              <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="adjust_deposit" name="adjust_deposit" value="1">
                                    <label class="form-check-label" for="adjust_deposit">Adjust Deposit</label>
                                </div>
                              <div class="row my-3">
                                  <div class="col-12 d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- // Basic multiple Column Form section end -->
  </div>
  @endsection
  @push('scripts')
  <script>
      $("input[name='receive_date']").daterangepicker({
          singleDatePicker: true,
          startDate: new Date(),
          showDropdowns: true,
          autoUpdateInput: true,
          format: 'dd/mm/yyyy',
      }).on('changeDate', function(e) {
          var date = moment(e.date).format('YYYY/MM/DD');
          $(this).val(date);
      });
  </script>
  @endpush