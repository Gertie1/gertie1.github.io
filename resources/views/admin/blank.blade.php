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

                    <form action="{{ URL::route('blank2') }}" method="post" id="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Year</label><br>
                            <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
                        </div>
                        <div class="form-group">
                            <label>Drugs</label><br>
                            <table class="table  table-bordered table-hover" id="table">
                                <thead>
                                <tr>

                                </tr>
                                </thead>
                                @foreach ($drugs->chunk(3) as $chunk)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                @foreach ($chunk as $drug)

                                                    <div class="col-xs-4">
                                                        <input type="hidden" name="drug[]" value="0" />
                                                        <input class="checkbox-inline" type="checkbox" name="drug[]" value="{{ $drug->id }}" id="{{ $drug->id }}">{{ $drug->name.' '.$drug->pack_size }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

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




