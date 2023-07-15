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
                                      <p class="m-0"><strong>Customer Name : {{optional($invoice->user)->name}} <br> Customer ID :{{$invoice->customer_id}}</strong></p>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <p class="m-0"><strong>Invoice No : {{$invoice->id}}</strong></p>
                                  </div>
                                  <hr>
                                  <input type="hidden" value="{{$invoice->customer_id}}" name="customer_id">
                                  <input type="hidden" value="{{$invoice->id}}" name="invoice_id">
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="type">Payment Type</label>
                                          <select name="type" class="form-control">
                                              <!-- <option value="">Select</option> -->
                                              <option value="2" selected>Allocated</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="currency">Currency</label>
                                          <select name="currency" class="form-control">
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
                                          <input type="text" id="amount" class="form-control" placeholder="Amount" name="amount">
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