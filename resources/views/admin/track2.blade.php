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
                <h1 class="page-header">Drug History</h1>
            </div>
            <!--End Page header-->
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
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                            @endif

                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>

                                    <th class="text-center">Batch Number</th>
                                    <th class="text-center">Quantity Received</th>
                                    <th class="text-center">Date Received </th>
                                    <th class="text-center">Quantity Sold</th>
                                    <th class="text-center">Date Sold </th>

                                </tr>
                                </thead>
                                @foreach($drugs as $key => $item)
                                    <tr id="item{{$item->id}}">
                                        <td>{{$item->id}}</td>

                                        <td>{{$item->batch_number}}</td>
                                        <td>{{$item->quantity_received}}</td>
                                        <td>{{$item->complete_received}}</td>
                                        <td>{{$item->quantity_sold}}</td>
                                        <td>{{$item->complete_sold}}</td>


                                    </tr>
                                @endforeach
                            </table>
                            {{--<div class="page-header" >{{ $drugs->links() }}</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="../resources/assets/assets/plugins/jquery/http_ajax.googleapis.com_ajax_libs_jquery_1.12.0_jquery.min.js"></script>
    <script src="../resources/assets/assets/plugins/bootstrap/http_maxcdn.bootstrapcdn.com_bootstrap_3.3.6_js_bootstrap.min.js"></script>


    </body>
    </html>

@stop