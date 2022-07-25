
@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="container">
            @if ($errors->any())
                <div class="row bs-callout bs-callout-danger">
                    <div class="col-lg-12">
                        <h4>{{trans('web.correct_form')}}</h4>
                        <ul class='ulerror'>
                            {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                        </ul>
                    </div>
                </div>
            @endif

            {{ Form::open(array('route' => array('reservations.store',$room->id), 'method' => 'POST', 'id' => 'form')) }}

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h1 class="page-header">{{ trans('web.create', array('attribute'=> strtolower(trans_choice('web.reservation',1))))}} {{$room->name}} {{trans('web.in')." ".$room->hotel->name}}</h1>
                        </div>

                        <div class="panel-body">

                            @include('reservations.form')

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div>
                        {{ Form::submit(trans('web.submit'), array('class' => 'btn btn-info')) }}
                        <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('web.back') }}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>


@stop

@section('beforeclosebody')
    <script language="JavaScript">

        $(document).ready(function() {

            $.noConflict();
            $('#checkin').datepicker({
                autoclose: true,
                minDate: 0,
                dateFormat: "yy/m/d",
                onSelect: function(dateText, inst){
                    $("#checkout").datepicker("option","minDate",
                        $("#checkin").datepicker("getDate"));
                }
            });

            $('#checkout').datepicker({
                dateFormat: "yy/m/d",
                autoclose: true
            });
        })
    </script>
@stop


