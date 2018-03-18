<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">

		{!! Form::file('cover') !!}
		@if (isset($Home) && $Home->cover)
		<p>
		    <b>Gambar Saat Ini :</b>
			{!! Html::image(asset('img/img1/'.$Home->cover), null, ['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover2', 'Cover 2', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">

		{!! Form::file('cover2') !!}
		@if (isset($Home) && $Home->cover)
		<p>
		    <b>Gambar Saat Ini :</b>
			{!! Html::image(asset('img/img1/'.$Home->cover2), null, ['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('cover2', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover3', 'Cover 3', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">

		{!! Form::file('cover3') !!}
		@if (isset($Home) && $Home->cover3)
		<p>
		    <b>Gambar Saat Ini :</b>
			{!! Html::image(asset('img/img1/'.$Home->cover3), null, ['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('cover3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-8 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>
