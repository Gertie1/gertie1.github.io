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
                <h3 class="page-header">Quantity to be procured</h3>
            </div>
            <!--End Page header-->
        </div>

        {{--<div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                    </div>


                </div>
            </div>
        </div>--}}


       {{-- <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                    </div>

                    <div class="col-md-10">
                        <a href="{{ URL::route('likely2') }}" class="btn btn-primary">SELECT DRUG</a>
                        --}}{{--<button class="btn btn-primary" type="button" id="rarely" value="rarely" >SELECT DRUG</button>--}}{{--
                        --}}{{--<button class="btn btn-primary" type="button" id="add" value="add" >ADD DRUG</button>--}}{{--
                    </div>
                </div>
            </div>
        </div>--}}



        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Drugs
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                           {{-- <form action="#" method="get" id="frmsearch">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search">

                            </form>--}}
                            {{--<button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i></button>--}}

                        </div>
                        <div class="table-responsive">
                           {{-- @include('admin.likely2')--}}

                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                <tr>

                                    <th class="text-center">Name</th>
                                    <th class="text-center">MOS</th>
                                    <th class="text-center">Predicted Stock</th>
                                    <th class="text-center">Average Sales</th>
                                    <th class="text-center">Amount Remaining</th>
                                    <th class="text-center">Stock needed</th>


                                </tr>
                                </thead>

                                {{--@foreach (array_merge($stocks, $stock2) as $key => $item)--}}
                           @foreach($stocks as $key => $item)
                                <tr>
                                    {{--<tr id="item{{$item['name']}}">--}}
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->mos}}</td>

                                    <td>{{number_format($item->total_sales,0)/2}}</td>
                                    <td>{{number_format($item->average_sales,0)}}</td>
                                    <td>{{number_format($item->total_amount,0)}}</td>

                                    <td>{{number_format($item->total_sales,0)/2- $item->total_amount}} </td>

                                    {{--<td>{{number_format($item->total_sales,0)/2}}</td>--}}

                                    </tr>

                                @endforeach


                            </table>
                           {{-- <div class="page-header" >{{ $stocks->links() }}</div>--}}
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


        $('#rarely').on('click', function () {
            $('#often_form').modal('show');

            $('#save').val('Submit');
            $('#frmDrug').trigger('reset');

            console.log("Button clicked");
        });

        /* $('#frmDrug').on('submit',function(e){
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
         '<td>'+ data.year +'</td>' +
         '<td>'+ data.month +'</td>' +

         '</tr>';
         if(state=='save'){
         $('tbody').append(row);
         }



         $('#frmDrug').trigger('reset');
         $('#name').focus();
         }

         });
         });*/



        /* $('tbody').delegate('.btn-delete','click',function(){
         var value=$(this).data('id');
         var url='{{--{{URL::to('deleteStock')}}--}}';
         if(confirm('Are you sure you want to delete?')==true)
         {
         $.ajax({
         type:'post',
         url:url,
         data:{'id':value},
         success:function(data){
         $('#item'+value).remove();
         }

         });
         }
         });

         $('#search').on('keyup',function(){
         $value=$(this).val();
         $.ajax({
         type:'get',
         url:'{{--{{URL::to('searchStock')}}--}}',
         data:{'search':$value},
         success:function (data) {
         $('tbody').html(data);

         }
         });
         })

         */


    </script>
    </body>
    </html>

@stop