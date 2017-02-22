@extends('layouts.dashboard2')
@section('content')


    <html>
    <head>

        <meta name="_token" content="{!! csrf_token() !!}"/>

        <script src="../resources/assets/assets/plugins/bootstrap/http_maxcdn.bootstrapcdn.com_bootstrap_3.3.6_js_bootstrap.min.js"></script>
        <script src="../resources/assets/assets/plugins/jquery/http_ajax.googleapis.com_ajax_libs_jquery_1.12.0_jquery.min.js"></script>

    </head>
    <body>
    <div id="page-wrapper">

        <div class="row">
            <!-- Page header-->
            <div class="col-lg-12">
                <h1 class="page-header">Weather</h1>
            </div>
            <!--End Page header-->
        </div>

        <div class="container">
            @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>

            @endif

            <div class="modal-body">
                <form action="{{ URL::route('newWeather') }}" method="post" id="">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('rainfall') ? ' has-error' : '' }}" id="error">
                        <label for="rainfall">Rainfall:</label>
                        <input type="number" class="form-control" id="rainfall" name="rainfall"  placeholder="Rainfall">

                        @if ($errors->has('rainfall'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('rainfall') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('max_temp') ? ' has-error' : '' }}" id="error">
                        <label for="max_temp">Temperature:</label>
                        <input type="number" class="form-control" id="max_temp" name="max_temp" step="any" placeholder="Temperature">

                        @if ($errors->has('max_temp'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('max_temp') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}" id="error">
                        <label for="month">Month:</label>
                        <input type="text" class="form-control" id="month" name="month" placeholder="Month">

                        @if ($errors->has('month'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}" id="error">
                        <label for="year">Year:</label>
                        <input type="number" class="form-control" id="year" name="year"  placeholder="Year">

                        @if ($errors->has('year'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <input type="hidden" name="_method" id="id" value="post">
                    <div class="modal-footer">
                        <input type="submit" value="Save" id="save" class="btn btn-primary">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>


                </form>


            </div>
            <script type="text/javascript">
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                    }
                });


            </script>




        </div>
    </div>
    </body>
    </html>

@stop