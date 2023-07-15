  @extends('layout.app')

  @section('pageTitle','Create Payment')
  @section('pageSubTitle','Create')

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
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="customer_id">Select Customer Id</label>
                                          <select name="customer_id" class="form-control" required>
                                              <option value="">Select</option>
                                              @if(count($invoices))
                                              @foreach($invoices as $in)
                                              <option value="{{ $in->customer_id}}">Customer Id # {{$in->customer_id}} & Name # {{optional($in->user)->name}}</option>
                                              @endforeach
                                              @endif
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="type">Payment Type</label>
                                          <select name="type" class="form-control">
                                              <option value="">Select</option>
                                              <option value="1" selected>Deposit</option>
                                              {{--<option value="2">Allocated</option>
                                            <option value="3">Security Deposit</option>--}}
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="currency">Currency</label>
                                          <select name="currency" class="form-control">
                                              <option value="">Select</option>
                                              <option value="1">USD</option>
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
                                  {{--<div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="allocated">Allocated</label>
                                          <input type="text" id="allocated" class="form-control" placeholder="Allocated" name="allocated">
                                      </div>
                                  </div>--}}
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="deposit">Deposit</label>
                                          <input type="text" id="deposit" class="form-control" placeholder="Deposit" name="deposit">
                                      </div>
                                  </div>
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