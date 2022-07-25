<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::hidden('room_id',$room->id) }}
            {{ Form::label('guest_name', trans('web.guest')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('guest_name', null, array('class' => 'form-control', 'placeholder' => trans('web.guest')))}}
            {!!  $errors->first('guest_name', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('checkin', trans('web.checkin')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('checkin', null, array('class' => 'form-control datepicker', 'placeholder' => trans('web.checkin')))}}
            {!!  $errors->first('checkin', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('checkout', trans('web.checkout')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('checkout', null, array('class' => 'form-control datepicker', 'placeholder' => trans('web.checkout')))}}
            {!!  $errors->first('checkout', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>