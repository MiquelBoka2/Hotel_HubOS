
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

            {{ Form::model($room, array('method' => 'PUT', 'route' => array('rooms.update', $room->id))) }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h1 class="page-header">{{ trans('web.edit', array('attribute'=> strtolower(trans_choice('web.room',1))))}}</h1>
                        </div>

                        <div class="panel-body">
                            @include('rooms.form')


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


