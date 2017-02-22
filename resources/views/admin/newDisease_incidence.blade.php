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
                <h1 class="page-header">Incidence</h1>
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
                <form action="{{ URL::route('newIncidence') }}" method="post" id="">
                    {{ csrf_field() }}



                    <div class="form-group">
                        <label>Disease</label>
                        <select class="form-inline input-sm " name="disease" id="disease">
                            @foreach($diseases as $key => $disease)
                                <option value="{{$disease->id}}"> {{$disease->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}" id="error">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date">

                        @if ($errors->has('date'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                        @endif
                    </div>



                    <div class="form-group{{ $errors->has('incidence') ? ' has-error' : '' }}" id="error">
                        <label for="incidence">Incidence:</label>
                        <input type="number" class="form-control" id="incidence" name="incidence" step="any" placeholder="Incidence">

                        @if ($errors->has('incidence'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('incidence') }}</strong>
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