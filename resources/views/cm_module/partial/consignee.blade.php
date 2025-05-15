<div class="border p-2">
    <h5 class="text-center border-bottom my-3">Consignee's List</h5>
    <!-- table bordered -->
    <div class="table-responsive">
        <table class="table table-bordered mb-0 text-center">
        @if(currentUser() == 'salesexecutive')
            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.consigdetl.create',['id' => $client_data->id])}}"><i class="bi bi-pencil-square"></i></a>
        @endif    
            <thead>
                <tr>
                    <th scope="col" rowspan="2">{{__('#SL')}}</th>
                    <th colspan="8">Consignee</th>
                    <th colspan="8">Notify</th>
                    <th scope="col" rowspan="2">{{__('Notify Same')}}</th>
                    <th scope="col" rowspan="2">{{__('Permanent')}}</th>
                    <th scope="col" rowspan="2">{{__('Status')}}</th>
                    <th class="white-space-nowrap" rowspan="2">{{__('ACTION')}}</th>
                </tr>
                <tr>
                    <th scope="col">{{__('Name')}}</th>
                    <th scope="col">{{__('Country')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th scope="col">{{__('City')}}</th>
                    <th scope="col">{{__('Address')}}</th>
                    <th scope="col">{{__('ref Address')}}</th>
                    <th scope="col">{{__('Phone')}}</th>
                    <th scope="col">{{__('Email')}}</th>

                    <th scope="col">{{__('Name')}}</th>
                    <th scope="col">{{__('Country')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th scope="col">{{__('City')}}</th>
                    <th scope="col">{{__('Address')}}</th>
                    <th scope="col">{{__('refAddress')}}</th>
                    <th scope="col">{{__('Phone')}}</th>
                    <th scope="col">{{__('Email')}}</th>


                </tr>
            </thead>
            <tbody>
                @forelse($con_detl as $c)
                <tr>
                    <th scope="row">{{ ++$loop->index }}</th>
                    <td>{{$c->c_name}}</td>
                    <td>{{optional($c->country)->name}}</td>
                    <td>{{$c->c_state}}</td>
                    <td>{{$c->c_city}}</td>
                    <td>{{$c->c_address}}</td>
                    <td>{{$c->c_ref_address}}</td>
                    <td>{{$c->c_phone}}</td>
                    <td>{{$c->c_email}}</td>
                    <td>{{$c->n_name}}</td>
                    <td>{{optional($c->n_country)->name}}</td>
                    <td>{{$c->n_state}}</td>
                    <td>{{$c->n_city}}</td>
                    <td>{{$c->n_address}}</td>
                    <td>{{$c->n_ref_address}}</td>
                    <td>{{$c->n_phone}}</td>
                    <td>{{$c->n_email}}</td>
                    <td>{{$c->notify_same_as_con==1?"Yes":"No"}}</td>
                    <td>{{$c->per_con==1?"Yes":"No"}}</td>
                    <td>@if($c->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                    <td class="white-space-nowrap">
                        @if(currentUser() == 'superadmin')
                        <a href="{{route(currentUser().'.consigdetl.edit',encryptor('encrypt',$c->id))}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <!-- <a href="javascript:void()" onclick="$('#form{{$c->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                        <form id="form{{$c->id}}" action="{{route(currentUser().'.consigdetl.destroy',encryptor('encrypt',$c->id))}}" method="post">
                            @csrf
                            @method('delete')

                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <th colspan="21" class="text-center">No Consignee Detail Found</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>