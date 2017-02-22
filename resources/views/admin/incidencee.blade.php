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

            <div class="row">

                <div class="panel-body col-lg-11">

                    {!! Form::model($item,
                     [
                     'method' => 'PATCH',
                     'route' => ['updateIncidence', $item->id]


]) !!}

                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group{{ $errors->has('disease') ? ' has-error' : '' }}" id="error">
                        <input type="text" class="form-control" id="disease" name="disease" placeholder="Disease">

                        @if ($errors->has('disease'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('disease') }}</strong>
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

                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}" id="error">
                        <input type="number" class="form-control" id="year" name="year" placeholder="Enter Year">

                        @if ($errors->has('year'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}" id="error">
                        <input type="text" class="form-control" id="month" name="month" placeholder="Enter Month">

                        @if ($errors->has('month'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('incidence') ? ' has-error' : '' }}" id="error">
                        <input type="number" class="form-control" id="incidence" name="location" step="any"placeholder="Enter Incidence">

                        @if ($errors->has('incidence'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('incidence') }}</strong>
                                    </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>


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
        });

        /* $(document).ready(function () {
         var i=1;
         $('#add').click(function () {
         i++;
         $('#table').append('<tr id="row'+i+'"><div class="form-group"><td><select class="form-inline input-sm " name="drug[]" id="drug"> {{--@foreach($drugs as $key => $drug)--}}
        <option value="{{--{{$drug->id}}"> {{$drug->name}}--}}</option> {{--@endforeach--}}
        </select></td></div><td><div class="form-group"><input class="input-sm" type="number" class="form-control" id="amount_received" name="amount_received[]" placeholder="Amount received"></div></td><td><div class="form-group"> <input class="input-sm" type="number" class="form-control" id="amount_sold" name="amount_sold[]"  placeholder="Amount sold"> </div> </td> <td> <div class="form-group"> <input class="input-sm" type="date" class="form-control" id="date_received" name="date_received[]"  placeholder="Date received"> </div> </td> <td> <div class="form-group"> <input class="input-sm" type="date" class="form-control" id="date_sold" name="date_sold[]"  placeholder="Date sold"> </div></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn-remove">X</button></td></tr>');

         });
         $(document).on('click','.btn-remove',function () {
         var button_id = $(this).attr("id");
         $("#row"+button_id+"").remove();

         });


         });*/

    </script>






    </body>
    </html>

@stop


