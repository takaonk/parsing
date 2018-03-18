@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/blogs') }}">Blog</a></li>
				<li class="active">Tambah Blog</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah Blog</h2>
				</div>
				<div class="panel-body">
				{!! Form::open(['url' => route('blogs.store'),
					'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('blogs._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection