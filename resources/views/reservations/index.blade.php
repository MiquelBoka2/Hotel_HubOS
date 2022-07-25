@extends('layouts.app')


@section('content')


    <div class="content">
        <div class="container">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="page-header">
                        {{ trans_choice('web.reservation',2) }} {{$room->name}} {{trans('web.in')." ".$room->hotel->name}}
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                                <a style='margin-bottom:20px;' href="{{route('reservations.create',['room_id'=>$room->id])}}" class='btn btn-primary'>{{ trans('web.create', array('attribute'=> strtolower(trans_choice('web.reservation',1))))}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if ($reservations->count())
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover datatables">
                                        <thead>
                                        <tr>
                                            <th>{{trans('web.id')}}</th>
                                            <th>{{trans('web.guest')}}</th>
                                            <th>{{trans('web.checkin')}}</th>
                                            <th>{{trans('web.checkout')}}</th>
                                            <th>{{trans('web.status')}}</th>
                                            <th>{{trans('web.options')}}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $status = [trans('web.pending'),trans('web.checkin'),trans('web.checkout')];?>
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td>
                                                    {{$reservation->id}}
                                                </td>
                                                <td>
                                                    {{$reservation->guest_name}}
                                                </td>
                                                <td>
                                                    {{$reservation->checkin}}
                                                </td>
                                                <td id="checkout_cell_{{$reservation->id}}">
                                                    {{$reservation->checkout}}
                                                </td>
                                                <td id="status_cell_{{$reservation->id}}">
                                                    {{$status[$reservation->status]}}
                                                </td>
                                                <td>
                                                    @if($reservation->status<1)<a href="#" id_to_del='{{$reservation->id}}' class="btn btn-outline-success btn-sm action-btn btn-checkin" id="checkin{{$reservation->id}}">{{ trans('web.checkin') }}</a>@endif
                                                    @if($reservation->status<2)<a href="#" id_to_del='{{$reservation->id}}' class="btn btn-outline-danger btn-sm action-btn btn-checkout" id="checkout{{$reservation->id}}">{{ trans('web.checkout') }}</a>@endif
                                                    <a href="{{route('reservations.edit',$reservation->id)}}" class="btn btn-outline-info btn-sm action-btn edit" id="edit{{$reservation->id}}"><i class="fas fa-edit"></i></a>

                                                    <a href="#" id_to_del='{{$reservation->id}}' class="btn delperm btn-outline-danger btn-sm action-btn delete" id="delete{{$reservation->id}}"><i class="fas fa-trash-alt"></i></a>
                                                    {{ Form::open(array('method' => 'DELETE', 'route' => array('reservations.destroy', $reservation->id), 'id' => 'del_'.$reservation->id, 'name' => 'del_'.$reservation->id)) }}
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            @else
                                <p>{{trans('web.no_reservations')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center mt-30">{{trans('web.wantdeletedocument')}}</p>

                    <div class="row">
                        <div class="col pading text-center">
                            <a style='margin-bottom:20px;' href="#" class='btn btn-danger btn-del' id="modal_delete_btn">{{ trans('web.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div><
        </div>
    </div>

@stop

@section('beforeclosebody')


    <script>

        var id_to_del 	= "";
        $(document).ready(function() {

            $.noConflict();

            $('.datatables').dataTable({
                "pageLength": 10,
                dom: "<'row'<'col-sm-2'l><'col-sm-1'B><'col-sm-6'p><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "sPaginationType": "full_numbers",
                "oLanguage": { "sUrl": "{{ URL::asset('packages/datatables/lng/en.txt') }}"},
                "order": [[ 0, 'desc' ]],
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ]
            });

            $(".delperm").click(function (e) {

                id_to_del   = $(this).attr('id_to_del');

                e.preventDefault();
                $('.modal').modal({});

            });

            $(".btn-del").click(function (e) {
                name_form = "del_"+id_to_del;
                $("#"+name_form).submit();
            });


            $(".btn-checkin").click(function (e) {

                id_to_del   = $(this).attr('id_to_del');

                e.preventDefault();

                url = "{{route('reservations.checkin',["123456789"])}}";
                url = url.replace("123456789",id_to_del);

                $.ajax({
                    url : url,
                    method: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(result){
                        if(result["status"]=="Ok"){
                            $('#status_cell_'+id_to_del).html('{{$status[1]}}');
                            $('#checkin'+id_to_del).hide();

                        }
                    }
                });
            });
            $(".btn-checkout").click(function (e) {

                id_to_del   = $(this).attr('id_to_del');

                e.preventDefault();

                url = "{{route('reservations.checkout',["123456789"])}}";
                url = url.replace("123456789",id_to_del);

                $.ajax({
                    url : url,
                    method: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(result){
                        if(result["status"]=="Ok"){

                            $('#status_cell_'+id_to_del).html('{{$status[1]}}');
                            $('#checkout_cell_'+id_to_del).html(result["reservation"]["checkout"])
                        }
                    }
                });
            });


        });
    </script>

@stop


