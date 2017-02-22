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
                <h3 class="page-header">Weather</h3>
            </div>
            <!--End Page header-->
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                    </div>

                    <div class="col-md-10">

                        <a href="{{ URL::route('newWeather') }}" class="btn btn-primary">ADD NEW </a>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Weather Info
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <form action="#" method="get" id="frmsearch">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                {{--<button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i></button>--}}
                            </form>

                        </div>

                        @if(Session::has('flash_message'))
                            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                        @endif

                        <div class="table-responsive">
                            {{--@include('admin.newDrug')--}}
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Rainfall</th>
                                    <th class="text-center">Temperature</th>
                                    <th class="text-center">Month</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                @foreach($weathers as $key => $item)
                                    <tr id="item{{$item->id}}">
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->rainfall}}</td>
                                        <td>{{$item->max_temp}}</td>
                                        <td>{{$item->month}}</td>
                                        <td>{{$item->year}}</td>
                                        <td>

                                            <a href="{{ route('editWeather', $item->id) }}" class="edit-modal btn btn-info btn-edit">Edit</a>

                                            <button class="delete-modal btn btn-danger btn-delete" data-id="{{$item->id}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="page-header" >{{ $weathers->links() }}</div>
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


        $('tbody').delegate('.btn-delete','click',function(){
            var value=$(this).data('id');
            var url='{{URL::to('deleteWeather')}}';
            if(confirm('Are you sure you want to delete?')==true)
            {
                $.ajax({
                    type:'post',
                    url:url,
                    data:{'id':value},
                    success:function(data){
                        alert('Record has been deleted');
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
                url:'{{URL::to('searchWeather')}}',
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