@extends('layouts.dashboard2')
@section('content')

    <html>
    <head>

        <meta name="_token" content="{!! csrf_token() !!}"/>


    </head>
    <body>
    <div id="page-wrapper">

        <div class="row">
            <!-- Page header-->
            <div class="col-lg-12">
                <h3 class="page-header">Disease Incidence</h3>
            </div>
            <!--End Page header-->
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                    </div>

                    <div class="col-md-10">
                        <a href="{{ URL::route('newIncidence') }}" class="btn btn-primary">ADD INCIDENCE</a>
                        {{--<button class="btn btn-primary" type="button" id="add" value="add" >ADD INCIDENCE</button>--}}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Info
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <form action="#" method="get" id="frmsearch">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                {{--<button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i></button>--}}
                            </form>

                        </div>
                        <div class="table-responsive">
                           {{-- @include('admin.newDisease_incidence')--}}
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Disease</th>
                                    {{--<th class="text-center">Location</th>
                                    <th class="text-center">Year</th>--}}
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Incidence</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                @foreach($data as $key => $item)
                                    <tr id="item{{$item->id}}">
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->disease}}</td>
                                        {{--<td>{{$item->location}}</td>
                                        <td>{{$item->year}}</td>--}}
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->incidence}}</td>
                                        <td>
                                            <div class="col-lg-3">
                                                {{-- <button class="edit-modal btn btn-info btn-edit" data-id="{{$item->id}}">Edit</button>--}}
                                                <a href="{{ route('editIncidence', $item->id) }}" class="edit-modal btn btn-info btn-edit">Edit</a>
                                            </div>
                                            <button class="delete-modal btn btn-danger btn-delete" data-id="{{$item->id}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="page-header" >{{ $data->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="../resources/assets/assets/plugins/bootstrap/http_maxcdn.bootstrapcdn.com_bootstrap_3.3.6_js_bootstrap.min.js"></script>
    <script src="../resources/assets/assets/plugins/jquery/http_ajax.googleapis.com_ajax_libs_jquery_1.12.0_jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            }
        });
        /*$("#add").on('click', function () {
         $('#save').val('save');
         $('#frmDisease_incidence').trigger('reset');
         $("#item").modal('show');
         });
         $('#frmDisease_incidence').on('submit',function(e){
         e.preventDefault();
         var form=$('#frmDisease_incidence');
         var formData=form.serialize();
         var url=form.attr('action');
         var state=$('#save').val();
         var type='post';
         if(state=='update')
         {
         type='put';
         }
         $.ajax({
         type:type,
         url:url,
         data:formData,
         success:function(data){
         var row='<tr>'+
         '<td>'+ data.id +'</td>' +
         '<td>'+ data.disease +'</td>' +
         '<td>'+ data.location +'</td>' +
         '<td>'+ data.year +'</td>' +
         '<td>'+ data.month +'</td>' +
         '<td>'+ data.incidence +'</td>' +
         '<td><button class="edit-modal btn btn-info btn-edit" data-id="'+ data.id +'">Edit</button>'+
         '<button class="delete-modal btn btn-danger btn-delete" data-id="'+ data.id+'">Delete</button></td>' +
         '</tr>';
         if(state=='save'){
         $('tbody').append(row);
         }
         else{
         $('#item'+data.id).replaceWith(row);
         }

         $('#frmDisease_incidence').trigger('reset');
         $('#disease').focus();
         alert('Incidence Created Successfully');
         window.location.reload();


         },
         error: function(data){
         var errors = data.parseJSON;
         console.log(errors);
         alert('An error has occurred, please try again');
         // Render the errors with js ...
         }
         });
         });
         function addRow(data) {
         var row='<tr>'+
         '<td>'+ data.id +'</td>' +
         '<td>'+ data.disease +'</td>' +
         '<td>'+ data.location +'</td>' +
         '<td>'+ data.year +'</td>' +
         '<td>'+ data.month +'</td>' +
         '<td>'+ data.incidence +'</td>' +

         '<td><button class="edit-modal btn btn-info btn-edit">Edit</button>'+
         '<button class="delete-modal btn btn-danger btn-delete">Delete</button></td>' +
         '</tr>';
         $('tbody').append(row);
         }
         $('tbody').delegate('.btn-edit','click',function () {
         var value=$(this).data('id');
         var url='{{URL::to('getIncidenceUpdate')}}';
         console.log(url)
         $.ajax({
         type:'get',
         url:url,
         data:{'id':value},
         success:function(data){
         console.log(data);
         $('#id').val(data.id);
         $('#disease').val(data.disease);
         $('#location').val(data.location);
         $('#year').val(data.year);
         $('#month').val(data.month);
         $('#incidence').val(data.incidence);
         $('#save').val('update');
         $('#item').modal('show');

         }
         });
         });*/
        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteIncidence')}}';
            if(confirm('Are you sure you want to delete?')==true)
            {
                $.ajax({
                    type:'post',
                    url:url,
                    data:{'id':value},
                    success:function(data){
                        alert('Incidence has been deleted');
                        $('#item'+value).remove();
                        window.location.reload();
                    }
                });
            }
        });
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type:'get',
                url:'{{URL::to('searchIncidence')}}',
                data:{'search':$value},
                success:function (data) {
                    $('tbody').html(data);

                }
            });
        })


    </script>
    </body>
    </html>

@stop