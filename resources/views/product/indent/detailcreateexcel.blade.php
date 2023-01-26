@extends('layout.app')
@section('pageTitle','Create Indent Details')
@section('pageSubTitle','Create')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.indentdetails.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="fs-4 text-center">
                                            {{$ps->productstyle?->style_code}} - {{$ps->productstyle?->name}}
                                            <b class="fs-5 text-center">
                                                ({{$ps->indent_no}})
                                            </b>
                                        </div>
                                        <input type="hidden" name="indent_id" value="{{$ps->id}}">
                                    </div>
                                    <div class="offset-4 col-4 py-2">
                                        <input type="file" name="file" id="file" class="form-control" >
                                    </div>
                                    <div class="col-2 py-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="uploadexcel()">Upload</button>
                                    </div>
                                    
                                    <div class="col-12">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th>Unit</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Weight</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="details_data">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
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
@endsection

@push('scripts')

<script>
  
     function uploadexcel(){
     
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        // Get the selected file
        var files = $('#file')[0].files;
        if(files.length > 0){
           var fd = new FormData();
  
           // Append data 
           fd.append('file',files[0]);
           fd.append('_token',CSRF_TOKEN);
  
           // Hide alert 
           $('#responseMsg').hide();
  
           // AJAX request 
           $.ajax({
             url: "{{route(currentUser().'.ind.product_sc.excel')}}",
             method: 'post',
             data: fd,
             contentType: false,
             processData: false,
             dataType: 'json',
             success: function(response){
                $('#details_data').html(response);
             },
             error: function(response){
                console.log("error : " + JSON.stringify(response) );
             }
           });
        }else{
           alert("Please select a file.");
        }
  
      }
    </script>

@endpush