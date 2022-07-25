@extends('layouts.app')


@section('content')


    <div class="content">
        <div class="container">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="page-header">
                        {{ trans_choice('web.room',2) }} @if($hotel_id>0) {{' '.trans('web.in')." ".$hotel->name}}@endif
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($hotel_id>0)
                                <a style='margin-bottom:20px;' href="{{route('rooms.create_hotel',['hotel_id'=>$hotel_id])}}" class='btn btn-primary'>{{ trans('web.create', array('attribute'=> strtolower(trans_choice('web.room',1))))}}</a>
                            @else
                                <a style='margin-bottom:20px;' href="{{route('rooms.create')}}" class='btn btn-primary'>{{ trans('web.create', array('attribute'=> strtolower(trans_choice('web.room',1))))}}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if ($rooms->count())
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover datatables">
                                        <thead>
                                        <tr>
                                            <th>{{trans('web.id')}}</th>
                                            <th>{{trans_choice('web.hotel',1)}}</th>
                                            <th>{{trans('web.name')}}</th>
                                            <th>{{trans('web.capacity')}}</th>
                                            <th>{{trans('web.status')}}</th>
                                            <th>{{trans('web.options')}}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $status = [trans('web.free'),trans('web.occupied')];?>
                                        @foreach ($rooms as $room)
                                            <tr>
                                                <td>
                                                    {{$room->id}}
                                                </td>
                                                <td>
                                                    {{$room->hotel->name}}
                                                </td>
                                                <td>
                                                    {{$room->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$room->capacity}}
                                                </td>
                                                <td>
                                                    {{$status[$room->status]}}
                                                </td>
                                                <td>
                                                    <a href="{{route('reservations.index', array('room_id'=>$room->id))}}"  class="btn btn-outline-success btn-sm action-btn edit" id="reservations{{$room->id}}">{{trans_choice('web.reservation',2)}}</a>

                                                @if($hotel_id > 0)
                                                        <a href="{{route('rooms.edit_hotel', array('id'=>$room->id,'hotel_id'=>$hotel_id))}}"  class="btn btn-outline-info btn-sm action-btn edit" id="edit{{$room->id}}"><i class="fas fa-edit"></i></a>

                                                        <a href="#" id_to_del='{{$room->id}}' class="btn delperm btn-outline-danger btn-sm action-btn delete" id="delete{{$room->id}}"><i class="fas fa-trash-alt"></i></a>
                                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('rooms.destroy_hotel', $room->id,$hotel_id), 'id' => 'del_'.$room->id, 'name' => 'del_'.$room->id)) }}
                                                        {{ Form::close() }}
                                                    @else
                                                        <a href="{{route('rooms.edit', array($room->id))}}"  class="btn btn-outline-info btn-sm action-btn edit" id="edit{{$room->id}}"><i class="fas fa-edit"></i></a>

                                                        <a href="#" id_to_del='{{$room->id}}' class="btn delperm btn-outline-danger btn-sm action-btn delete" id="delete{{$room->id}}"><i class="fas fa-trash-alt"></i></a>
                                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('rooms.destroy', $room->id), 'id' => 'del_'.$room->id, 'name' => 'del_'.$room->id)) }}
                                                        {{ Form::close() }}
                                                    @endif



                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            @else
                                <p>{{trans('web.no_rooms')}}</p>
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


        });
    </script>

@stop


