<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
	{!! Form::label('jabatan', 'Jabatan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jabatan', null, ['class'=>'form-control']) !!}
		{!! $errors->first('jabatan', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('cover') !!}
		@if (isset($teammember) && $teammember->cover)
		<p>
			{!! Html::image(asset('img/'.$teammember->cover), null, ['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>