@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/jenis') }}">Jenis</a></li>
				<li class="active">Ubah Jenis</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Jenis</h2>
				</div>
				<div class="panel-body">
				{!! Form::model($jenis, ['url' => route('jenis.update', $jenis->id),
					'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('jenis._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection