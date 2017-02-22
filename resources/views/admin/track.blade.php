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
                <h1 class="page-header">Charts</h1>
            </div>
            <!--End Page header-->
        </div>


        <div class="container">

            <div class="row">

                <div class="panel-body col-lg-12">

                    <form action="{{ URL::route('track') }}" method="post" id="">
                        {{ csrf_field() }}

                        <div class="form-group">

                        <label>Drug</label>
                        <select class="form-inline input-sm " name="drug" id="drug">
                            @foreach($drugs as $key => $drug)
                                <option value="{{$drug->id}}">{{ $drug->name.' '.$drug->pack_size }}</option>
                            @endforeach
                        </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>





                </div>

            </div>
        </div>




    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            }
        })

    </script>






    </body>
    </html>

@stop




