@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/Product') }}">Product</a></li>
				<li class="active">Ubah Profil Product</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Profil Product</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($Product, ['url' => route('Product.update', $Product->id),
					'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('Product._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection