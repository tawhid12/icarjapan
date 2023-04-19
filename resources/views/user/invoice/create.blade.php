  @extends('layout.app')

  @section('pageTitle','Create Invoice')
  @section('pageSubTitle','Create')

  @section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.invoice.store')}}">
                              @csrf
                              <div class="row">
                                
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_name">Consignee Name</label>
                                          <input type="text" id="c_name" class="form-control" placeholder="Consignee Name" name="c_name">
                                      </div>
                                      @if($errors->has('c_name'))
                                      <span class="text-danger"> {{ $errors->first('c_name') }}</span>
                                      @endif
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_country_id">Consignee Country</label>
                                          <select name="c_country_id" class="form-control">
                                              <option value="">Select</option>
                                              @if(count($countries))
                                              @foreach($countries as $in)
                                              <option value="{{ $in->id}}">{{$in->name}}</option>
                                              @endforeach
                                              @endif
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_state">Consignee State</label>
                                          <input type="text" id="c_state" class="form-control" placeholder="Consignee State" name="c_state">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_city">Consignee City</label>
                                          <input type="text" id="c_city" class="form-control" placeholder="Consignee City" name="c_city">
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="c_address">Consignee Address</label>
                                          <textarea rows="4" id="c_address" name="c_address" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="c_ref_address">Consignee Refernce Address</label>
                                          <textarea rows="4" id="c_ref_address" name="c_ref_address" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_phone">Consignee Phone</label>
                                          <div><small>Press Space of each Phone Number example Given<br><strong>018xxxxxxxx 018xxxxxxxx</strong></small></div>
                                          <textarea rows="4" id="c_phone" name="c_phone" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_email">Consignee Email</label>
                                          <div><small>Press Space of each Email example Given<br><strong>test@example.com test2@example.com</strong></small></div>
                                          <textarea rows="4" id="c_email" name="c_email" class="form-control"></textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="c_name">Notify Name</label>
                                          <input type="text" id="n_name" class="form-control" placeholder="Notify Name" name="n_name">
                                      </div>
                                      @if($errors->has('n_name'))
                                      <span class="text-danger"> {{ $errors->first('n_name') }}</span>
                                      @endif
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="n_country_id">Consignee Country</label>
                                          <select name="n_country_id" class="form-control">
                                              <option value="">Select</option>
                                              @if(count($countries))
                                              @foreach($countries as $in)
                                              <option value="{{ $in->id}}">{{$in->name}}</option>
                                              @endforeach
                                              @endif
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="n_state">Notify State</label>
                                          <input type="text" id="n_state" class="form-control" placeholder="Notify State" name="n_state">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="n_city">Notify City</label>
                                          <input type="text" id="n_city" class="form-control" placeholder="Consignee City" name="n_city">
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="n_address">Notify Address</label>
                                          <textarea rows="4" id="n_address" name="n_address" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="n_ref_address">Consignee Refernce Address</label>
                                          <textarea rows="4" id="n_ref_address" name="n_ref_address" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="n_phone">Notify Phone</label>
                                          <div><small>Press Space of each Phone Number example Given<br><strong>018xxxxxxxx 018xxxxxxxx</strong></small></div>
                                          <textarea rows="4" id="n_phone" name="n_phone" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12">
                                      <div class="form-group">
                                          <label for="n_email">Notify Email</label>
                                          <div><small>Press Space of each Email example Given<br><strong>test@example.com test2@example.com</strong></small></div>
                                          <textarea rows="4" id="n_email" name="n_email" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-12 mt-5">
                                      <div class="form-group">
                                          <input type="checkbox" id="notify_same_as_con" name="notify_same_as_con" value="1">
                                          <label for="notify_same_as_con">Notify Same as Consignee</label>
                                      </div>
                                      <div class="form-group">
                                          <input type="checkbox" id="per_con" name="per_con" value="1">
                                          <label for="per_con">Permanent</label>
                                      </div>
                                  </div>


                                  <div class="col-12 d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>

                                  </div>
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