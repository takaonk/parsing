@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/contacts') }}">Contact Us</a></li>
				<li class="active">Ubah Contact Us</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Contact Us</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($contact, ['url' => route('contacts.update', $contact->id),
					'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
					@include('contacts._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection