<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	{!! Form::label('address', 'Address', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('address', null, ['class'=>'form-control']) !!}
		{!! $errors->first('address', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	{!! Form::label('phone', 'Phone', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('phone', null, ['class'=>'form-control']) !!}
		{!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	{!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('email', null, ['class'=>'form-control']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-8 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>