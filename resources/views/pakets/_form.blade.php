<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama Paket', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {!! $errors->has('jenis_id') ? 'has-error' : '' !!}">
	{!! Form::label('jenis_id', 'Nama Jenis', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('jenis_id', [''=>'']+App\Jenis::pluck('nama','id')->all(), null) !!}
		{!! $errors->first('jenis_id', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
{!! Form::label('harga', 'Harga', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::number('harga', null, ['class'=>'form-control', 'min'=>1]) !!}
	{!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('isi') ? ' has-error' : '' }}">
	{!! Form::label('isi', 'Isi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('isi', null, ['class'=>'form-control', 'min'=>1]) !!}
		{!! $errors->first('isi', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('cover') !!}
		@if (isset($paket) && $paket->cover)
		<p>
			{!! Html::image(asset('img/'.$paket->cover), null, ['class'=>'img-rounded img-responsive']) !!}
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