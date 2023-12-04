<div class="border p-2">
    <h5 class="text-center border-bottom my-3">Account Information</h5>
    @if(currentUser() != 'accountant')
    <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.userdetl.update',encryptor('encrypt',$client_details->user_id))}}">
    @endif    
        @csrf
        @method('patch')
        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$client_details->user_id)}}">
        @php $name = explode(' ',$client_data->name); @endphp
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="userName">First Name<span class="text-danger"></span></label>
                    <input type="text" id="firstName" class="form-control" name="firstName" value="{{isset($name[0])?$name[0]:''}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="userName">Last Name<span class="text-danger"></span></label>
                    <input type="text" id="lastName" class="form-control" name="lastName" value="{{isset($name[1])?$name[1]:''}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="userName">Wife/Husband Name<span class="text-danger"></span></label>
                    <input type="text" id="lastName" class="form-control" name="wife_husband_name" value="{{$client_details->wife_husband_name}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="userName">Father Name<span class="text-danger"></span></label>
                    <input type="text" id="lastName" class="form-control" name="father_name" value="{{$client_details->father_name}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="userName">Mother Name<span class="text-danger"></span></label>
                    <input type="text" id="lastName" class="form-control" name="mother_name" value="{{$client_details->mother_name}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="contactNumber">Contact Number <span class="text-danger"></span></label>
                    <input type="text" id="contact_no" class="form-control" name="contact_no" value="{{$client_details->contact_no}}">
                </div>
                @if($errors->has('contact_no'))
                <span class="text-danger"> {{ $errors->first('contact_no') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="contactNumber">Whats Up<span class="text-danger"></span></label>
                    <input type="text" id="whatsapp" class="form-control" name="whatsapp" value="{{$client_details->whatsapp}}">
                </div>
                @if($errors->has('whatsapp'))
                <span class="text-danger"> {{ $errors->first('whatsapp') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="contactNumber">Facebook<span class="text-danger"></span></label>
                    <input type="text" id="facebook" class="form-control" name="facebook" value="{{$client_details->facebook}}">
                </div>
                @if($errors->has('facebook'))
                <span class="text-danger"> {{ $errors->first('facebook') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="contactNumber">Viver<span class="text-danger"></span></label>
                    <input type="text" id="viver" class="form-control" name="viver" value="{{$client_details->viver}}">
                </div>
                @if($errors->has('viver'))
                <span class="text-danger"> {{ $errors->first('viver') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="gmail">Gmail<span class="text-danger"></span></label>
                    <input type="text" id="gmail" class="form-control" name="gmail" value="{{$client_details->gmail}}">
                </div>
                @if($errors->has('gmail'))
                <span class="text-danger"> {{ $errors->first('gmail') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="instagram">Instagram<span class="text-danger"></span></label>
                    <input type="text" id="instagram" class="form-control" name="instagram" value="{{$client_details->instagram}}">
                </div>
                @if($errors->has('instagram'))
                <span class="text-danger"> {{ $errors->first('instagram') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="address1">Personal Address<span class="text-danger"></span></label>
                        <textarea id="address1" class="form-control" name="address1" rows="5">{{$client_details->address1}}</textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="address2">Office Address<span class="text-danger"></span></label>
                        <textarea id="address2" class="form-control" name="address2" rows="5">{{$client_details->address2}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
            </div>
        </div>
    </form>
</div>