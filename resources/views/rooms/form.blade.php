<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            {{ Form::hidden('current_hotel',$hotel_id) }}
            {{ Form::label('hotel_id', trans_choice('web.hotel',1)) }} (<span class='mandatory'>*</span>)
            {{ Form::select('hotel_id', $hotels, (isset($room) ? $room->hotel_id : $hotel_id), array('class' => 'form-control', 'placeholder' => trans_choice('web.hotel',1)))}}
            {!!  $errors->first('hotel_id', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('floor', trans('web.floor')) }} (<span class='mandatory'>*</span>)
            {{ Form::number('floor', null, array('class' => 'form-control', 'placeholder' => trans('web.floor')))}}
            {!!  $errors->first('floor', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            {{ Form::label('name', trans('web.name')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('web.name')))}}
            {!!  $errors->first('name', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('capacity', trans('web.capacity')) }} (<span class='mandatory'>*</span>)
            {{ Form::number('capacity', null, array('class' => 'form-control', 'placeholder' => trans('web.capacity')))}}
            {!!  $errors->first('capacity', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>