@extends('layout.app')
@section('pageTitle','Subcategory List')
@section('pageSubTitle','List')

@section('content')

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <?php
                //print_r($subcategories);
                ?>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.subcategory.create')}}"><i class="bi bi-pencil-square"></i></a>
                            <thead>
                                <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Name</th>
                                    <th class="white-space-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($subcategories as $sub)
                                <tr>
                                <th scope="row">{{ ++$loop->index }}</th>

                                    <td>{{$sub->category?->category}}</td>
                                    <td>{{$sub->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.subcategory.edit',encryptor('encrypt',$sub->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                       
                                        <form id="form{{$sub->id}}" action="{{route(currentUser().'.subcategory.destroy',encryptor('encrypt',$sub->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="3" class="text-center">No Pruduct Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- Bordered table end -->


@endsection