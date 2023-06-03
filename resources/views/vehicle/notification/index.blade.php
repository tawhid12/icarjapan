@extends('layout.app')

@section('pageTitle','Notification List')
@section('pageSubTitle','List')

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.brand.create')}}"><i class="bi bi-pencil-square"></i></a>
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Title')}}</th>
                                        <th scope="col">{{__('Read Status')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($notification as $n)
                                    <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$n->name}}</td>
                                        <td>{{$n->title}}</td>
                                        <td>@if($n->type == 1) {{__('Purchased') }} @else {{__('Reserved') }} @endif</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.notification.edit',$n->id)}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a href="javascript:void()" onclick="$('#form{{$n->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <form id="form{{$n->id}}" action="{{route(currentUser().'.notification.destroy',$n->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Notification  Found</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pt-2">
                            {{ $notification->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

