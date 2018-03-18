@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/Home') }}">Home</a></li>
				<li class="active">Ubah Halaman Home</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Halaman Home</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($Home, ['url' => route('Home.update', $Home->id),
					'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('Home._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection