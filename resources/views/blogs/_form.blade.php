<div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
	{!! Form::label('judul', 'Judul', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('judul', null, ['class'=>'form-control']) !!}
		{!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {!! $errors->has('categoris_id') ? 'has-error' : '' !!}">
	{!! Form::label('categoris_id', 'Categori', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('categoris_id', [''=>'']+App\Categori::pluck('nama','id')->all(), null) !!}
		{!! $errors->first('categoris_id', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
	{!! Form::label('about', 'About', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('about', null, ['class'=>'form-control', 'min'=>1]) !!}
		{!! $errors->first('about', '<p class="help-block">:message</p>') !!}
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