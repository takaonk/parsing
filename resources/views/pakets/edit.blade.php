@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/pakets') }}">Paket</a></li>
				<li class="active">Ubah Paket</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Paket</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($paket, ['url' => route('pakets.update', $paket->id),
					'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('pakets._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection