{{--<html>
<body>
<!-- Modal -->
<div class="modal fade" id="item" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body">--}}
@extends('layouts.dashboard')
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
                <h1 class="page-header">Settings</h1>
            </div>
            <!--End Page header-->
        </div>

        <div class="container">

            <div class="row">
                <form action="{{ URL::route('newSetting') }}" method="post" id="frmSetting">
                    {{ csrf_field() }}

                    {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="error">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}" id="error">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location">

                        @if ($errors->has('location'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <input type="hidden" name="id" id="id" value="">
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