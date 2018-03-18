<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama Jenis', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-8 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>