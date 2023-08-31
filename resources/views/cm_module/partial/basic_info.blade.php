<div class="table-responsive my-3">
    <table class="table table-bordered mb-0">
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
                    <select class="form-control" name="cmType">
                        <option value="">Select</option>
                        <option value="1">Dealer</option>
                        <option value="2">Individual</option>
                        <option value="3">Broker</option>
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
                <td rowspan="4" colspan="3">Bahadarhat</td>
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
                <td rowspan="2">SP *</td>
                <td rowspan="2">CM **</td>
                <td colspan="2">Update User</td>
            </tr>
            <tr>
                <td>Md Tawhidul Alam</td>
                <td>Update Date</td>
            </tr>
        </thead>
    </table>
</div>