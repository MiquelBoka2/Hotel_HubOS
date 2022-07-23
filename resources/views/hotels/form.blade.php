<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('name', trans('web.name')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('web.name')))}}
            {!!  $errors->first('name', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('street', trans('web.address')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('street', null, array('class' => 'form-control', 'placeholder' => trans('web.address')))}}
            {!!  $errors->first('street', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('postal_code', trans('web.postal_code')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('postal_code', null, array('class' => 'form-control', 'placeholder' => trans('web.postal_code')))}}
            {!!  $errors->first('postal_code', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('city', trans('web.city')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => trans('web.city')))}}
            {!!  $errors->first('city', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('country', trans('web.country')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('country', null, array('class' => 'form-control', 'placeholder' => trans('web.country')))}}
            {!!  $errors->first('country', "<p class='error'>:message</p>") !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('email', trans('web.email')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('web.email')))}}
            {!!  $errors->first('email', "<p class='error'>:message</p>") !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('phone', trans('web.phone')) }} (<span class='mandatory'>*</span>)
            {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder' => trans('web.phone')))}}
            {!!  $errors->first('phone', "<p class='error'>:message</p>") !!}
        </div>
    </div>

</div>