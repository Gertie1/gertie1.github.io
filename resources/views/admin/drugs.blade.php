@extends('layouts.dashboard')
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
                <h3 class="page-header">Drugs</h3>
            </div>
            <!--End Page header-->
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                    </div>

                    <div class="col-md-10">
                        <button class="btn btn-primary" type="button" id="add" value="add" >ADD DRUG</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Drug Info
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <form action="#" method="get" id="frmsearch">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                {{--<button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i></button>--}}
                            </form>

                        </div>
                        <div class="table-responsive">
                            @include('admin.newDrug')
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Pack Size</th>
                                    <th class="text-center">MOS</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                @foreach($drugs as $key => $item)
                                    <tr id="item{{$item->id}}">
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->pack_size}}</td>
                                        <td>{{$item->mos}}</td>
                                        <td>
                                            <div class="col-lg-3">
                                                <button class="edit-modal btn btn-info btn-edit" data-id="{{$item->id}}">Edit</button>
                                            </div>
                                            <button class="delete-modal btn btn-danger btn-delete" data-id="{{$item->id}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="page-header" >{{ $drugs->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="../resources/assets/assets/plugins/jquery/http_ajax.googleapis.com_ajax_libs_jquery_1.12.0_jquery.min.js"></script>
    <script src="../resources/assets/assets/plugins/bootstrap/http_maxcdn.bootstrapcdn.com_bootstrap_3.3.6_js_bootstrap.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            }
        });
        $("#add").on('click', function () {
            $('#save').val('save');
            $('#frmDrug').trigger('reset');
            $("#item").modal('show');
        });
        $('#frmDrug').on('submit',function(e){
            e.preventDefault();
            var form=$('#frmDrug');
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
                            '<td>'+ data.name +'</td>' +
                            '<td>'+ data.pack_size +'</td>' +
                            '<td>'+ data.mos +'</td>' +
                            '<td><button class="edit-modal btn btn-info btn-edit" data-id="'+ data.id +'">Edit</button>'+
                            '<button class="delete-modal btn btn-danger btn-delete" data-id="'+ data.id+'">Delete</button></td>' +
                            '</tr>';
                    if(state=='save'){
                        $('tbody').append(row);
                    }
                    else{
                        $('#item'+data.id).replaceWith(row);
                    }

                    $('#frmDrug').trigger('reset');
                    $('#name').focus();
                    alert('Drug Created Successfully');
                    window.location.reload();


                },
                error: function(data){
                    var errors = data.parseJSON;
                    console.log(errors);
                    alert('Drug already exists');
                    // Render the errors with js ...
                }
            });
        });
        function addRow(data) {
            var row='<tr>'+
                    '<td>'+ data.id +'</td>' +
                    '<td>'+ data.name +'</td>' +
                    '<td>'+ data.pack_size +'</td>' +
                    '<td>'+ data.mos +'</td>' +
                    '<td><button class="edit-modal btn btn-info btn-edit">Edit</button>'+
                    '<button class="delete-modal btn btn-danger btn-delete">Delete</button></td>' +
                    '</tr>';
            $('tbody').append(row);
        }
        $('tbody').delegate('.btn-edit','click',function () {
            var value=$(this).data('id');
            var url='{{URL::to('getDrugUpdate')}}';
            console.log(url)
            $.ajax({
                type:'get',
                url:url,
                data:{'id':value},
                success:function(data){
                    console.log(data);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#pack_size').val(data.pack_size);
                    $('#mos').val(data.mos);
                    $('#save').val('update');
                    $('#item').modal('show');

                }
            });
        });
        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteDrug')}}';
            if(confirm('Are you sure you want to delete?')==true)
            {
                $.ajax({
                    type:'post',
                    url:url,
                    data:{'id':value},
                    success:function(data){
                        alert('Drug has been deleted');
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
                url:'{{URL::to('searchDrug')}}',
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