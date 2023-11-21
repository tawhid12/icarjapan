<div class="table-responsive my-3">
    @if(currentUser() == 'salesexecutive')
    <form class="d-flex" action="{{route(currentUser().'.cm_category',encryptor('encrypt',$client_data->id))}}" method="post">
        @csrf
        @method('patch')
        @endif
        <table class="basicinfo table table-bordered mb-0">
            <thead>
                <tr>
                    <th scope="col">{{__('Customer Type')}}</th>
                    <td>@if($client_data->cmType) {{$client_data->cmType}} @else - @endif</td>
                    <th rowspan="2" scope="col">{{__('Sales Rank')}}</th>
                    <td rowspan="2">@if($sales_rank > 0) D @else N @endif
                    </td>
                    <th scope="col">{{__('ShipOK cars')}}</th>
                    <td>0</td>
                    <th scope="col">{{__('Catagory')}}</th>
                    <td>

                        <select class="form-control" name="cm_category">
                            <option value="">Select</option>
                            <option value="1" @if($client_data->cm_category == 1) selected @endif>Dealer</option>
                            <option value="2" @if($client_data->cm_category == 2) selected @endif>Individual</option>
                            <option value="3" @if($client_data->cm_category == 3) selected @endif>Broker</option>
                        </select>

                    </td>

                </tr>
                <tr>
                    <th scope="col">{{__('Customer Name')}}</th>
                    <td>{{$client_data->name}}</td>
                    <th scope="col">{{__('ReleaseOK Cars')}}</th>
                    <td>0</td>
                    <th rowspan="3" scope="col">{{__('Sales Note')}}</th>
                    <td rowspan="3">-</td>
                </tr>
                <tr>
                    <th scope="col">{{__('Country')}}</th>
                    <td>
                        <select class="form-control" name="country_id" style="width:150px;">
                            <option value="">Select</option>
                            @forelse($countries as $c)
                            <option value="{{$c->id}}" @if($client_data->country_id == $c->id) selected @endif>{{$c->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </td>
                    <th rowspan="2" scope="col">{{__('Port')}}</th>
                    <td rowspan="2">
                        <select class="form-control" name="port_id" style="width:150px;">
                            <option value="">Select</option>
                            @forelse($ports as $p)
                            <option value="{{$p->id}}" @if($client_data->port_id == $p->id) selected @endif>{{$p->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </td>
                    <th scope="col">{{__('CM Reserve Cars')}}</th>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="col">{{__('Division')}}</th>
                    <td>-</td>
                    <th scope="col">{{__('Cancel Cars')}}</th>
                    <td>0</td>
                </tr>
                <tr>
                    <th rowspan="4" scope="col">{{__('Address')}}</th>
                    <td rowspan="4" colspan="3">{{$client_details->address1}}</td>
                    <th rowspan="3" scope="col">{{__('Delay Payment Cars')}}</th>
                    <td rowspan="3">0</td>
                    <th rowspan="3" scope="col">{{__('Why not buy')}}</th>
                    <td rowspan="3">-</td>
                </tr>
                <tr height="50px"></tr>
                <tr height="50px"></tr>
                <tr>
                    <th scope="col">{{__('Deal Status')}}</th>
                    <td>-</td>
                    <th rowspan="3" scope="col">{{__('How can he buy again')}}</th>
                    <td rowspan="3">-</td>
                </tr>
                <tr>
                    <th rowspan="4" scope="col">{{__('Language')}}</th>
                    <td rowspan="4">English</td>
                    <th scope="col">{{__('Currency')}}</th>
                    <td>$</td>
                    <th scope="col">{{__('Watch CM')}}</th>
                    <td>-</td>
                </tr>
                <tr>
                    <th rowspan="3" scope="col">{{__('Deposit Radio')}}</th>
                    <td rowspan="3">%</td>
                </tr>
                <tr>
                    <td rowspan="2">@if($client_data->cmType==1) SP * @endif</td>
                    <td rowspan="2">@if($client_data->cmType==2) CM ** @endif</td>
                    <td colspan="2">Update User</td>
                </tr>
                <tr>
                    <td>Md Tawhidul Alam</td>
                    <td>Update Date</td>
                </tr>
                @if(currentUser() == 'salesexecutive')
                <tr>
                    <td colspan="8">
                        <button type="submit" class="ms-2 btn btn-primary my-2">Update</button>
                    </td>
                </tr>
                @endif
            </thead>
        </table>
    </form>
    @if(currentUser() == 'salesexecutive')
    @if(!$client_data->executiveId)
    <form action="{{route(currentUser().'.assignTo')}}" style="display: inline;">
        @csrf
        <input name="user_id" type="hidden" value="{{$client_data->id}}">
        <a href="javascript:void(0)" data-name="{{$client_data->name}}" class="assignTo ms-2 btn btn-success my-2" data-toggle="tooltip" title="Assign To Myself">Assign To Myself</a>
    </form>
    @else
    <form action="{{route(currentUser().'.freeUser')}}" style="display: inline;">
        @csrf
        <input name="user_id" type="hidden" value="{{$client_data->id}}">
        <a href="javascript:void(0)" data-name="{{$client_data->name}}" class="freeUser ms-2 btn btn-danger my-2" data-toggle="tooltip" title="Free From Myself">Free From Myself</a>
    </form>
    @endif
    @endif

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $('.assignTo').on('click', function(event) {
        var name = $(this).data("name");
        var title = `Are you sure you want to Assign  this Client ${name}?`
        event.preventDefault();
        swal({
                title: title,
                text: "If you Proceed this, Client will be Assigned.",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().submit();
                }
            });
    });
    $('.freeUser').on('click', function(event) {
        var name = $(this).data("name");
        var title = `Are you sure you want to Free  this Client ${name}?`
        event.preventDefault();
        swal({
                title: title,
                text: "If you Proceed this, Client will be Free.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().submit();
                }
            });
    });
</script>